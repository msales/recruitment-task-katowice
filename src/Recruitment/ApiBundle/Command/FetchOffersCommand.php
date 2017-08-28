<?php

namespace Recruitment\ApiBundle\Command;

use Recruitment\ApiBundle\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class FetchOffersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:fetch-offers')
            ->setDescription('It Returns Offers for a given Advertiser')
            ->setHelp('This Command accepts an advertiser ID as a parameter and will return the offers of that advertiser')
            ->addArgument('advertiser_id', InputArgument::REQUIRED, 'The Advertiser ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id=$input->getArgument('advertiser_id');
        if(!is_numeric($id)) throw new \InvalidArgumentException('Invalid ID');

        // fetch offer data for that advertiser
        $offers=$this->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(OfferRepository::class)
            ->findBy(['advertiser_id'=>$id]);
        if (!$offers) {
            throw $this->createNotFoundException(
                'No offers found for this advertiser id '.$id
            );
        }

        //return data
    }
}