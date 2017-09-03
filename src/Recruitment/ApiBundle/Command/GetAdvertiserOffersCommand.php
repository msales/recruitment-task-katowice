<?php

namespace Recruitment\ApiBundle\Command;

use Exception;
use Recruitment\ApiBundle\Util\Advertisers\Advertiser1;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Debug\Exception\ClassNotFoundException;


/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 12:18
 */
class GetAdvertiserOffersCommand extends ContainerAwareCommand
{
  /**
   * Configure the CLI command
   */
  protected function configure()
  {
    $this
      ->setName('app:get-advertiser-offers')
      ->setDescription('Retrieves offers for the given advertiser ID')
      ->setHelp('Provide the command with an advertiser id to get all the offers')
      ->addArgument('advertiser_id', InputArgument::REQUIRED, 'Advertiser ID');
  }

  /**
   * @param InputInterface $input
   * @param OutputInterface $output
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {

    //read advertiser_id command input
    $advertiserId = $input->getArgument('advertiser_id');

    //abort if we do not have a valid advertiser id
    if (!is_numeric($advertiserId)) {
      throw new \InvalidArgumentException('advertiser_id.invalid');
    }

    //get the api service instance
    $apiService = $this->getContainer()->get("api_service");

    //get the offers from the service
    try {
      $offers = $apiService->getOffersByAdvertiserId(intval($advertiserId));
    } catch (Exception $e){
        die("No offers found ...");
    }

    //iterate on the offers
    foreach ($offers as $offer){

      //compose the class name dynamically
      $class_name = '\Recruitment\ApiBundle\Util\Advertisers\Advertiser' . $advertiserId;

      //initialie the class
      try {
        /** @var BaseAdvertiser $advertiserInstance */
        $advertiserInstance = new $class_name($offer);
      } catch (\ClassNotFoundException $e){
        die("No handler defined for advertiser with id [$advertiserId]. ");
      }

      //check if the offer is already saved in the database
      $offer = $this->getContainer()
                  ->get('doctrine')
                  ->getRepository(Offer::class)
                  ->findOneByApplicationId($advertiserInstance->getCampaignId());

      if ($offer instanceOf Offer){
        $output->writeln('Offer with app id ' . $advertiserInstance->getCampaignId() . ' already imported. Skipping to next ..' );
        continue;
      }

      //if currency is not USD we abort
      if ($advertiserInstance->getPayoutCurrency() !== "USD"){
        $output->writeln("Only USD Currency supported for the moment ...");
        die();
      }

      //create a new offer instance
      $offer = new Offer();
      $offer->setAdvertiserId($advertiserInstance->getAdvertiserId());
      $offer->setApplicationId($advertiserInstance->getCampaignId());
      $offer->setPlatform($advertiserInstance->getPlatform());
      $offer->setCountry($advertiserInstance->getCountry());
      $offer->setName($advertiserInstance->getOfferName());
      $offer->setPayout($advertiserInstance->getPayoutAmount());

      try {

        //get the doctrine entity manager instance and persist the offer instance
        $entityManager = $this->getContainer()->get('doctrine')->getManager();
        $entityManager->persist($offer);
        $entityManager->flush();
        $output->writeln('Saved Offer with id ' . $offer->getApplicationId());

      } catch (\Exception $e) {
          $output->writeln($e->getMessage());
      }

    }//endFor

  }//endExecute

}
