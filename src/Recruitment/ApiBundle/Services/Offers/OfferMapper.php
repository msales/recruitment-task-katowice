<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:25
 */

namespace Recruitment\ApiBundle\Services\Offers;

use Recruitment\ApiBundle\Dummies\DummyOffer;
use Recruitment\ApiBundle\Entity\Offer;

/**
 * This class generates a valid Offer entity from a DummyOffer, making the mapping between fields,
 * in the example exposed is pretty simple because the relationship is one to one.
 */
class OfferMapper
{
    /**
     * @param DummyOffer $dummy
     * @return Offer
     */
    public static function buildFromDummy(DummyOffer $dummy)
    {
        $offer = new Offer();
        $offer->setApplicationId($dummy->getApplicationId());
        $offer->setName($dummy->getName());
        $offer->setCountry($dummy->getCountry());
        $offer->setPayout($dummy->getPayout());
        $offer->setPlatform($dummy->getPayout());

        return $offer;
    }
}