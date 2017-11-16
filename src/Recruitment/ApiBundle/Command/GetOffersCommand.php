<?php

namespace Recruitment\ApiBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Recruitment\ApiBundle\Service\OfferService;
use Recruitment\ApiBundle\Factory\OfferFactory;

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
        $offer_factory = new OfferFactory;

        $offers_response = json_decode($offer_service->get(
            $offer_service->getRoute($base_url, $advertiserId, $offerId)
        ), JSON_OBJECT_AS_ARRAY );


        $em->persist($offer_factory->create($offers_response));

        $em->flush();
    }
}
