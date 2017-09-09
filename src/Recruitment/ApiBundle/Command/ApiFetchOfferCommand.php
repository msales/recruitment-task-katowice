<?php

namespace Recruitment\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ApiFetchOfferCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('api:fetch-offers')
            ->setDescription('Fetches offers for advertiser, based on advertiser id.')
            ->addArgument('advertiser_id', InputArgument::REQUIRED, 'Advertiser id')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = (int)$input->getArgument('advertiser_id');
        $result =
            $this->getContainer()
                 ->get('recruitment.provider.advertiser_data_provider')
                 ->getBulkData(['entityName' => 'Advertiser', 'entityId' => $advertiserId])
        ;

        if (empty($result)) {
            $output->writeln("No results found!");

            exit();
        }

        $output->writeln(count($result) . ' results found...');
        /** @var \Recruitment\ApiBundle\Mapper\OfferEntityMapper $offerEntityMapper */
        $offerEntityMapper =
            $this->getContainer()
                 ->get('recruitment.mapper.offer')
        ;
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        foreach ($result as $data) {
            $offer = $offerEntityMapper->map($data);
            $entityManager->persist($offer);
        }

        $entityManager->flush();

        $output->writeln('Command result.');
    }

}
