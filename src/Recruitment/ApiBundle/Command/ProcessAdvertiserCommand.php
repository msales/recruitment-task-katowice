<?php

namespace Recruitment\ApiBundle\Command;

use Doctrine\ORM\EntityManager;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Exceptions\RemoteDataException;
use Recruitment\ApiBundle\Services\Offers\OffersFetcherInterface;
use Recruitment\ApiBundle\Services\Offers\OfferStrategyBuilder;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessAdvertiserCommand extends ContainerAwareCommand
{
    /** @var OffersFetcherInterface */
    protected $offersFetcher;
    /** @var OfferStrategyBuilder */
    protected $offerStrategyBuilder;

    /**
     * @param OffersFetcherInterface $offersFetcher
     */
    public function __construct(OffersFetcherInterface $offersFetcher, OfferStrategyBuilder $offerStrategyBuilder)
    {
        parent::__construct();
        $this->offersFetcher = $offersFetcher;
        $this->offerStrategyBuilder = $offerStrategyBuilder;
    }

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

        $output->writeln('Processing offers of advertiser '.$advertiserId);

        try {
            $offers = $this->offersFetcher->getOffersOfAdvertiser($advertiserId);
        }catch (RemoteDataException $e){
            $output->writeln('<error>'.$e->getMessage().'</error>');
            return;
        }

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $offerRepository = $em->getRepository(Offer::class);

        foreach ($offers as $offerAsArray) {

            $offer = $this->offerStrategyBuilder->buildOffer($offerAsArray);
            $output->write('Processing applicationId ' . $offer->getApplicationId());
            if (!$offerRepository->findOneBy(['applicationId' => $offer->getApplicationId()])) {
                $em->persist($offer);
                $output->writeln(' -');
            } else {
                $output->writeln(' already in DB');
            }
        }

        $em->flush();

        $output->writeln('Command done.');
    }
}
