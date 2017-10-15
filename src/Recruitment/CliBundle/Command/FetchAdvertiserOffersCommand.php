<?php

namespace Recruitment\CliBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchAdvertiserOffersCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName("app:advertisers:fetchOffers");
        $this->setDescription("fetch specified advertiser's offers");
        $this->addArgument("advertiserId", InputArgument::REQUIRED);
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument("advertiserId");
        $this->getContainer()->get("app.advertiser_service")->persistOffers($advertiserId);
    }
}