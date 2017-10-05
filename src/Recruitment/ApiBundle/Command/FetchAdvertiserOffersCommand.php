<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Command;

use Exception;
use GuzzleHttp\Client;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Exception\Command\WrongAdvertiserIdFormatException;
use Recruitment\ApiBundle\Exception\OfferExistsException;
use Recruitment\ApiBundle\Util\JsonParsers\JsonParserFactory;
use Recruitment\ApiBundle\Util\Services\OfferService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FetchAdvertiserOffersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('api:fetch-offers')
            // the short description shown while running "php bin/console list"
            ->setDescription('Fetches  offers for advertiser.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to fetch offers for advertiser using it\'s id.')
            // configure an argument
            ->addArgument('advertiserId', InputArgument::REQUIRED, 'Id of the advertiser');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = $input->getArgument('advertiserId');

        if (!ctype_digit($advertiserId)) {
            throw new WrongAdvertiserIdFormatException("Advertiser Id must be integer digit!");
        }

        $advertiserId = intval($advertiserId);
        $parser = JsonParserFactory::make($advertiserId);

        $this->getContainer()->get('router')->getContext()->setHost(
            $this->getContainer()->getParameter('dev_server_host')
        );
        $url = $this->getContainer()->get('router')
            ->generate(
                'fetch_offers',
                ['advertiser' => 'advertiser', 'advertiserId' => $advertiserId],
                UrlGeneratorInterface::ABSOLUTE_URL
            );
        $client = new Client();
        $response = $client->get($url, ['connect_timeout' => 60])->getBody()->getContents();
        $parsedData = $parser->parse($response);

        /**
         * @var OfferService $offerService
         */
        $offerService = $this->getContainer()->get('recruitment.services.offer_service');

        foreach ($parsedData as $data) {
            try {
                $offerService->create($data);
            } catch (OfferExistsException $e) {
                continue;
            } catch (Exception $e) {
                throw $e;
            }
        }

        $offers = $offerService->all();
        $output->writeln(["Offers in database now", '--------------------------------------------------------']);
        $output->writeln('id  |  application_id  | name  |  payout  |  platform  |  country');

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                /**
                 * @var Offer $offer
                 */
                $output->write($offer->getId() . '  |  ');
                $output->write($offer->getApplicationId() . '  |  ');
                $output->write($offer->getName() . '  |  ');
                $output->write($offer->getPayout() . '  |  ');
                $output->write($offer->getPlatform() . '  |  ');
                $output->write($offer->getCountry() . "\n");
            }
        }

        $output->writeln('--------------------------------------------------------');
    }
}