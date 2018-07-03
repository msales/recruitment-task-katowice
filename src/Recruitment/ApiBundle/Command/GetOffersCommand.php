<?php

namespace Recruitment\ApiBundle\Command;

use Doctrine\ORM\EntityManager;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Util\Advertisers\AdvertiserFactory;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetOffersCommand extends ContainerAwareCommand
{
    const API_ENDPOINT_ALL = "advertiser/%d/offers";
    const API_ENDPOINT_ONE = "advertiser/%d/offer/%d";
    
    protected function configure()
    {
        $this
            ->setName('get:offers')
            ->setDescription('Get Advertiser offers')
            ->addArgument('adv-id', InputArgument::REQUIRED, 'Advertiser ID')
            ->addArgument('offer-id', InputArgument::OPTIONAL, 'Offer ID')
        ;
    }

  /**
   * @param InputInterface $input
   * @param OutputInterface $output
   * @return int
   */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument('adv-id');
        $offerId = $input->getArgument('offer-id');

        $baseUrl = $this->getContainer()->getParameter('host');
        $endpoint = $this->setEndPoint($advertiserId, $offerId);
        $url = sprintf(
          "http://%s/%s",
          $baseUrl,
          $endpoint
          );

        try {
            $data = file_get_contents($url);
        } catch (\Exception $e) {
            $output->writeln("Advertiser ID or Offer ID not found");
            return 1;
        }

        if (($data = $this->isJson($data)) === false) {
            $output->writeln("Invalid json");
            return 1;
        }

        /** @var EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine')->getEntityManager();
        $entityManager->beginTransaction();
        $progress = new ProgressBar($output, count($data));
        foreach ($data as $offer) {
            $advertiser = AdvertiserFactory::getInstance($advertiserId, $offer);
            $offer = $entityManager
              ->getRepository(Offer::class)
              ->findOneBy([
                "applicationId" => $advertiser->getApplicationId()
              ]);
            if (empty($offer)) {
                $offer = new Offer();
            }
            $offer
                ->setApplicationId($advertiser->getApplicationId())
                ->setCountry($advertiser->getCountry())
                ->setName($advertiser->getName())
                ->setPayout($advertiser->getPayout())
                ->setPlatform($advertiser->getPlatform());
            $entityManager->persist($offer);
            $progress->advance();
        }
        $entityManager->flush();
        $entityManager->commit();
        $progress->finish();
        echo "\n";

        return 0;
    }

  /**
   * @param int $advertiserId
   * @param int $offerId
   * @return string
   */
    private function setEndPoint($advertiserId, $offerId)
    {
        $endpoint = sprintf(self::API_ENDPOINT_ALL, $advertiserId);
        if (is_numeric($offerId)) {
            $endpoint = sprintf(self::API_ENDPOINT_ONE, $advertiserId, $offerId);
        }

        return $endpoint;
    }

  /**
   * @param $string
   * @return bool|array
   */
    private function isJson($string)
    {
        $data = json_decode($string, TRUE);
        if (json_last_error() != JSON_ERROR_NONE) {
            $data = false;
        }
         return $data;
    }
}
