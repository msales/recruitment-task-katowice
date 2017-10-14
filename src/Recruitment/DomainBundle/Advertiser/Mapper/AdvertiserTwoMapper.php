<?php

namespace Recruitment\DomainBundle\Advertiser\Mapper;

use Alcohol\ISO3166\ISO3166;
use Recruitment\DomainBundle\Advertiser\Value\Platform;
use Recruitment\DomainBundle\Entity\Offer;

class AdvertiserTwoMapper implements AdvertiserMapper
{
    public function map(array $data): Offer
    {
        $offer = new Offer();
        $offer->setApplicationId($data["id"]);
        $offer->setAdvertiserId($data["advertiser_id"]);
        $offer->setCountry($this->getCountryAlpha2($data["campaigns"]["countries"]));
        $offer->setPayout($this->getPayoutByPoints($data["campaigns"]["points"]));
        $offer->setPlatform(new Platform($data["app_details"]["platform"]));
        $offer->setName($data["app_details"]["bundle_id"]); // no name found

        return $offer;
    }

    private function getCountryAlpha2(array $countries): string
    {
        return (new ISO3166())->getByAlpha3($countries[0])["alpha2"];
    }

    private function getPayoutByPoints(int $points)
    {
        return $points / 1000; // TODO multiply by 100 and save ints instead of floats to avoid issues with approximations
    }
}