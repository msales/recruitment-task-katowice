<?php

namespace Recruitment\DomainBundle\Advertiser\Mapper;

use Alcohol\ISO3166\ISO3166;
use Recruitment\DomainBundle\Advertiser\Value\Platform;
use Recruitment\DomainBundle\Entity\Offer;

class AdvertiserOneMapper implements AdvertiserMapper
{
    public function map(array $data): Offer
    {
        throw new \Exception("not implemented");
    }
}