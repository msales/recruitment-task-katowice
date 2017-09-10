<?php
/**
 * AppGetOffersCommand.php description
 *
 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date 2017-09-10
 * @since TODO ${VERSION}
 * @package Recruitment\ApiBundle\Command
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */

namespace Recruitment\ApiBundle\Command;

use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\Doctrine\DBAL\Types\EnumPlatformType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AppGetOffersCommand
 *
 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date 2017-09-10
 * @since TODO ${VERSION}
 * @package Recruitment\ApiBundle\Command
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */
class AppGetOffersCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since TODO ${VERSION}
     */
    protected function configure()
    {
        $this->setName('app:get-offers')
            ->setDescription('Get offers given an advertiser ID')
            ->addArgument('id', InputArgument::REQUIRED, 'Advertiser\'s ID')
            ->addOption('offer_id', 'o', InputArgument::OPTIONAL, 'Get a specific offer given the offer ID');
    }

    /**
     * @inheritdoc
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since TODO ${VERSION}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiserId = (int)$input->getArgument('id');
        $offerId = (int)$input->getOption('offer_id');

        if ($advertiserId < 1) {
            throw new InvalidArgumentException('ID must be a positive integer');
        }

        if ($offerId && $offerId < 1) {
            throw new InvalidArgumentException('Offer ID must be a positive integer');
        }

        $endpoint = "http://msales-katowice-trial.app/advertiser/{$advertiserId}/".($offerId ? "offer/{$offerId}" : 'offers');

        $buzz = $this->getContainer()->get('buzz');

        $response = $buzz->get($endpoint);

        $offers = @json_decode($buzz->get($endpoint)->getContent());

        if (!$response) {
            $output->writeln('<error>Unable to get a valid response</error>');

            return 1;
        }

        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $success = 0;

        foreach ($offers as $o) {
            if (!isset($o->id) || $o->id < 1) {
                continue;
            }

            $o = $this->sanitizeValidateData($o, $output);

            if (!$o) {
                $output->writeln('<error>Failed to validate data for offer</error>');
                continue;
            }

            $offer = $em->getRepository(Offer::class)->findOneBy(['applicationId' => $o->mobile_app_id]);

            // if offer doesn't exist then create a new one, else just update the values
            if (!$offer) {
                $offer = new Offer();
                $offer->setApplicationId($o->mobile_app_id);
            }

            $offer->setName(filter_var($o->name, FILTER_SANITIZE_STRING));
            $offer->setPlatform($o->mobile_platform);
            $offer->setCountry($o->countries);
            $offer->setPayout($o->payout_amount);

            try {
                $em->persist($offer);
                $success++;
            } catch (\Exception $e) {
                $output->writeln('<error>Failed to write to DB</error>');
            } finally {
                $em->flush();
            }
        }

        $output->writeln('');
        $output->writeln('Offers updated: '.$success);
        $output->writeln('Offers failed to update: '.(count($offers) - $success));

        return 0;
    }

    /**
     * Validate and sanitize data provided by the endpoint
     *
     * @param $data
     * @param OutputInterface $output
     * @return bool|\stdClass
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since TODO ${VERSION}
     */
    protected function sanitizeValidateData($data, $output)
    {
        if (!isset($data->name)) {
            $output->writeln('<error>Invalid name</error>');

            return false;
        }

        $v = filter_var($data->name, FILTER_SANITIZE_STRING);
        if (!$v) {
            $output->writeln('<error>Invalid name</error>');

            return false;
        }
        $data->name = $v;

        if (!isset($data->mobile_app_id)) {
            $output->writeln('<error>Invalid app id</error>');

            return false;
        }

        $v = filter_var($data->mobile_app_id, FILTER_SANITIZE_NUMBER_INT);
        if (!$v) {
            $output->writeln('<error>Invalid app id</error>');

            return false;
        }
        $data->mobile_app_id = $v;

        if (!isset($data->mobile_platform)) {
            $output->writeln('<error>Invalid platform2</error>');

            return false;
        }

        $v = filter_var($data->mobile_platform, FILTER_SANITIZE_STRING);
        if (!$v || !in_array($v, EnumPlatformType::getType('enumplatform')->getValues())) {
            $output->writeln('<error>Invalid platform</error>');

            return false;
        }
        $data->mobile_platform = $v;

        if (!isset($data->points)) {
            if (!isset($data->payout_amount) || strtolower($data->payout_currency) !== 'usd') {
                $output->writeln('<error>Invalid currency</error>');

                return false;
            }

            $v = filter_var($data->payout_amount, FILTER_SANITIZE_NUMBER_FLOAT);
            if (!$v) {
                $output->writeln('<error>Invalid amount</error>');

                return false;
            }
            $data->payout_amount = $v;
        } else {
            $points = (int)$data->points;
            if ($points < 0) {
                $output->writeln('<error>Invalid points</error>');

                return false;
            }
            $data->payout_amount = $points * 0.001;
        }

        if (!isset($data->countries) || !is_array($data->countries)) {
            $output->writeln('<error>Invalid countries</error>');

            return false;
        }

        foreach ($data->countries as $country) {
            if (!preg_match('/[a-z]/i', $country)) {
                $output->writeln('<error>Invalid country</error>');

                return false;
            }
        }

        return $data;
    }
}