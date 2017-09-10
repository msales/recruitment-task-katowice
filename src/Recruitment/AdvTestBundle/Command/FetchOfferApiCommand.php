<?php

namespace Recruitment\AdvTestBundle\Command;

use Recruitment\AdvTestBundle\Controller\AdvController;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchOfferApiCommand extends Command
    //class FetchApiCommand extends ContainerAwareCommand
{
    /**
     * @var \Recruitment\AdvTestBundle\Controller\AdvController $adv_controller
     */
    private $adv_controller;
    
    public function __construct(AdvController $adv_controller)
    {
        parent::__construct();
        $this->adv_controller = $adv_controller;
    }
    
    protected function configure()
    {
        $this->setName('app:fetch-adv-api-single')
            ->setDescription('Fetch the advertiser api.')
            ->setHelp('This command allows you to fetch the information from the advertiser api')
            ->addArgument('advertiserId', InputArgument::REQUIRED, 'The id of the advertiser.')
            ->addArgument('offerId', InputArgument::REQUIRED, 'The id of the offer.')
        ;
    }
    
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if(is_null($input->getArgument('advertiserId'))){
            $output->writeln('The id of the advertiser is missing!');
        }elseif(is_null($input->getArgument('offerId'))){
            $output->writeln('The id of the offer is missing!');
        }
    }
    //php bin/console app:fetch-adv-api-single 1 1
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
                             'Fetch the offer from the Advertiser '.$input->getArgument('advertiserId'),
                             '==============================================================================',
                             '',
                         ]);
        
        $res = $this->adv_controller->addSingleOfferFromAdviserAction(
            $input->getArgument('advertiserId'),
            $input->getArgument('offerId')
            );
        
        $output->write($res);
        $output->write('==============================================================================');
    }
}