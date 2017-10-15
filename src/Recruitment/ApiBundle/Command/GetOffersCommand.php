<?php

namespace Recruitment\ApiBundle\Command;

use Recruitment\ApiBundle\Service\CountryCodeService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Recruitment\ApiBundle\Service\OfferService;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Service\ConversionService;
use Recruitment\ApiBundle\Service\AdvertiserRateService;

class GetOffersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('offer:get')
            ->setDescription('Fetch an offer from an advertiser.')
            ->addArgument('advertiserId', InputArgument::REQUIRED, 'Id of the advertiser')
            ->addArgument('offerId', InputArgument::OPTIONAL, 'Id of the offer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument('advertiserId');
        $offerId = $input->getArgument('offerId') ?: 0;

        $base_url = $this->getContainer()->get('router')->getContext()->getHost();
        $offer_service = new OfferService($this->getContainer()->get('guzzle.client.api_crm'));
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $offers_response = (array)json_decode($offer_service->get(
            $offer_service->getRoute($base_url, $advertiserId, $offerId)
        ));

        $offers = $offer_service->getCampaigns($offers_response);
        $app_details = $offer_service->getAppDetails($offers_response);
        $advertiser_id = $offers_response['advertiser_id'];

        foreach ($offers as $offer_data) {
            $offer = new Offer;

            $offer->setApplicationId(json_encode($offer_data));

            $offer->payout = isset($offer_data['payout_amount']) ?
                $offer_data['payout_amount'] :
                ConversionService::convertPayout(
                    $offer_data['points'],
                    AdvertiserRateService::getRate($advertiser_id)
                );

            $offer->currency = AdvertiserRateService::CURRENCY;
            $offer->country = CountryCodeService::convertToIso2(current($offer_data['countries']));
            $offer->name = isset($offer_data['name']) ? $offer_data['name'] : '';
            $offer->platform = $offer_service->getPlatform($app_details ?: $offer_data);

            $em->persist($offer);
        }
        $em->flush();

        $output->writeln(count($offers) . ' offer(s) saved.');
    }
}
