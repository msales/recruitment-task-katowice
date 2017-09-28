<?php

namespace Recruitment\ApiBundle\Command;

use Doctrine\ORM\EntityManager;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Entity\RemoteDataException;
use Recruitment\ApiBundle\Util\PatternsApplied\OfferCollectionBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessAdvertiserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('process:advertiser')
            ->setDescription('Fetch an advertiser, get its offers and persist them in DB')
            ->addArgument('advertiser_id', InputArgument::REQUIRED, 'Advertiser ID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument('advertiser_id');

        $endpointUrl = str_replace('{advertiserId}', $advertiserId, $this->getContainer()->getParameter('advertisers_endpoint'));

        try {
            $data = $this->getRemoteData($endpointUrl);
            $data = json_decode($data, true);
        }catch (RemoteDataException $e){
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return;
        }

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $offerRepository = $em->getRepository(Offer::class);

        foreach ($data as $item) {
            $offers = OfferCollectionBuilder::build($item)->getOffers();

            foreach ($offers as $offer) {
                $output->write('Processing applicationId ' . $offer->getApplicationId());
                if (!$offerRepository->findOneBy(['applicationId' => $offer->getApplicationId()])) {
                    $em->persist($offer);
                    $output->writeln(' -');
                } else {
                    $output->writeln(' already in DB');
                }
            }
        }

        $em->flush();

        $output->writeln('Command done.');
    }

    /**
     * @param string $url
     * @return bool|string
     * @throws RemoteDataException
     */
    protected function getRemoteData($url)
    {
        $handler = curl_init();
        curl_setopt_array($handler, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Remote Access System',
            CURLOPT_HEADER => 1,
        ]);
        $response = curl_exec($handler);

        $header_size = curl_getinfo($handler, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        curl_close($handler);

        if(strpos($header, 'HTTP/1.1 200') !== 0){
            throw new RemoteDataException($header);
        }

        return $body;
    }
}
