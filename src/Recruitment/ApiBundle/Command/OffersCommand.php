<?php

namespace Recruitment\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OffersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('advertiser')
            ->setDescription('Set offers from a specific advertiser')
            ->addArgument(
                'advertiserId',
                InputArgument::REQUIRED,
                'Advertiser id'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument('advertiserId');

        //A controller is only responsible of getting http request
        //And because it will take time to reuse the wheel here
        //We just make an http call to our controller
        //The controller is only responsible of everything, since it is http request
        $client   = $this->getContainer()->get('guzzle.client.msales');
        $apiUrl   = sprintf($this->getContainer()->getParameter('api')['advertiser_offers_url'], $advertiserId);
        $response = $client->get($apiUrl, [
            'headers'   => [
                'content-type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        $output->writeln($content);
    }
}