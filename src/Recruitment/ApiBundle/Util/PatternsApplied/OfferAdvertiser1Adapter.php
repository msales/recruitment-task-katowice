<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:49
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\PatternsApplied;

use Recruitment\ApiBundle\Entity\Offer;

class OfferAdvertiser1Adapter implements OfferAdvertiserAdapterInterface
{
    /**
     * @param array $data
     * @return OfferCollection
     */
    public function extractOfferCollection(array $data): OfferCollection
    {
        $collection = new OfferCollection();
        foreach($data['countries'] as $country) {
            $applicationId = join(':', [$data['advertiser_id'], $data['campaign_id'], $data['mobile_app_id'], $country]);
            $offer = new Offer();
            $offer->setCountry($country);
            $offer->setApplicationId($applicationId);
            $offer->setName($data['name']);
            $offer->setPlatform($data['mobile_platform']);
            $offer->setPayout($data['payout_amount']);

            $collection->addOffer($offer);
        }

        return $collection;
    }
}