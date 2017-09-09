<?php

namespace Recruitment\ApiBundle\Mapper;

use Doctrine\ORM\EntityManager;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Repository\OfferRepository;

class OfferEntityMapper
{
    const POINT_PRICE = 0.001;

    /**
     * @param array $data
     * @param \Recruitment\ApiBundle\Repository\OfferRepository $repository
     *
     * @return \Recruitment\ApiBundle\Entity\Offer
     */
    public function map(array $data, OfferRepository $repository): Offer
    {
        // Process advertiser with id 2
        if (array_key_exists('app_details', $data) && array_key_exists('campaigns', $data)) {
            $offer = $repository->findOrNew($data['campaigns']['cid']);
            $offer->setApplicationId($data['campaigns']['cid'])
                  ->setCountry(array_shift($data['campaigns']['countries']))
                  ->setName($data['app_details']['developer'].' - '.$data['app_details']['version'])
                  ->setPayout(number_format($data['campaigns']['points'] * self::POINT_PRICE, 2, '.', ''))
                  ->setPlatform($data['app_details']['platform'])
            ;

            return $offer;
        }

        $offer = $repository->findOrNew($data['campaign_id']);
        $offer->setApplicationId($data['campaign_id'])
              ->setCountry(array_shift($data['countries']))
              ->setName($data['name'])
              ->setPayout($data['payout_amount'])
              ->setPlatform($data['mobile_platform'])
        ;

        return $offer;
    }
}