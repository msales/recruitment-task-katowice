<?php

namespace Recruitment\ApiBundle\Command;


use Exception;
use Recruitment\ApiBundle\Controller\OffersController;
use Recruitment\ApiBundle\Factory\AdvertiserOfferFactory;
use Recruitment\ApiBundle\Service\Provider\GuzzleHttpClient;
use Recruitment\ApiBundle\Util\Advertisers\AdvertiserOffer1;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Service\OffersApiService;
use Recruitment\ApiBundle\Util\Advertisers\BaseAdvertiserOffer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Asset\Packages;
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
   * @var OffersController
   */
  private $offersController;

  public function __construct(OffersController $offersController)
  {
    parent::__construct();
    $this->offersController = $offersController;
  }

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
    $advertiserId = $input->getArgument('advertiser_id');

    $this->offersController->saveOffersByAdvertiserId($advertiserId);

  }


}
