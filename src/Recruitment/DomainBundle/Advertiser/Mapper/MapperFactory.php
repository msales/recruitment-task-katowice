<?php

namespace Recruitment\DomainBundle\Advertiser\Mapper;

class MapperFactory
{
    public function build(int $advertiserId): AdvertiserMapper
    {
        if (2 === $advertiserId) {
            return new AdvertiserTwoMapper();
        }
        if (1 === $advertiserId) {
            return new AdvertiserOneMapper();
        }

        throw new \Exception("no mapper defined for advertiser with id: {$advertiserId}");
    }
}