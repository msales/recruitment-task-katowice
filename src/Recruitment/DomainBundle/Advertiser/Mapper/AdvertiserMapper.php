<?php

namespace Recruitment\DomainBundle\Advertiser\Mapper;

use Recruitment\DomainBundle\Entity\Offer;

interface AdvertiserMapper
{
    public function map(array $data): Offer;
}