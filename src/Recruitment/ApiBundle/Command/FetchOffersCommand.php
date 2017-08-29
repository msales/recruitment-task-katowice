<?php

namespace Recruitment\ApiBundle\Command;

use Recruitment\ApiBundle\Entity\Currency;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Entity\Payout;
use Recruitment\ApiBundle\Entity\PayoutInterface;
use Recruitment\ApiBundle\Entity\PayoutSimple;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;


/**
 * Class FetchOffersCommand
 * @package Recruitment\ApiBundle\Command
 */
class FetchOffersCommand extends ContainerAwareCommand
{
    /**
     * Setup the CLI Command
     */
    protected function configure()
    {
        $this
            ->setName('app:fetch-offers')
            ->setDescription('It Returns Offers for a given Advertiser')
            ->setHelp('This Command accepts an advertiser ID as a parameter and will return the offers of that advertiser')
            ->addArgument('advertiser_id', InputArgument::REQUIRED, 'The Advertiser ID');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //get the provided advertiser_id
        $id=$input->getArgument('advertiser_id');
        if(!is_numeric($id)) throw new \InvalidArgumentException('Invalid ID');
        $offers = $this->getData($id);

        // getDoctrine Repository

        $em=$this->getContainer()
            ->get('doctrine')
            ->getManager();

        foreach($offers as $offer){

            //2 types of record structures exist in the endpoint
            //if campaign_id exists
            $newOffer = new Offer();
            $objType=1;
            try {
                $campaign = $offer->campaign_id;
            } catch (\Exception $e) {
                $objType=2;
            }

            if($objType == 1) {

                //setup for the first type
                //this exists only in the one structure type
                //and will trigger the exception

                $newOffer->setAdvertiserId($offer->advertiser_id);
                $newOffer->setCountry($offer->countries[0]);
                $newOffer->setName($offer->name);
                $newOffer->setApplicationId($offer->mobile_app_id);
                $newOffer->setPlatform($offer->mobile_platform);
                $payout=new PayoutSimple($offer->payout_amount, new Currency($offer->payout_currency));
                $newOffer->setPayout($payout);
            } else {
                //setup for the second type
                $newOffer->setAdvertiserId($offer->advertiser_id);
                $newOffer->setCountry($offer->campaigns->countries[0]);
                //$newOffer->setName($offer->app_details->category);
                //$newOffer->setApplicationId($offer->campaigns->cid);
                //$newOffer->setPlatform($offer->app_details->platform);
                //$payout = new Payout($offer->campaigns->points, new Currency('USD'));
                //$newOffer->setPayout($payout);
            }

            try{
                $em->persist($newOffer);
                $em->flash();
                $output->writeln('Saved Offer for ' . $offer->advertiser_id);
            } catch (\Exception $e){
                $output->writeln($e->getMessage());
            }
        }
    }

    /**
     * @param $advertiser_id
     * @return mixed
     * @throws \Exception
     */
    protected function getData($advertiser_id)
    {
        //engage guzzle http to retrieve data from the endpoint
        $client = new Client(['base_uri'=>'http://msales-katowice-trial.app:8082/']);
        $uri = 'advertiser/'.$advertiser_id.'/offers';
        $res = $client->get($uri);
        //basic error handling
        if($res->getStatusCode()<>200) {
            throw new \Exception('Invalid Request');
        }

        return json_decode($res->getBody());
    }
}