<?php

namespace Recruitment\DomainBundle\Advertiser;

use Recruitment\DomainBundle\Advertiser\Mapper\AdvertiserMapper;
use Recruitment\DomainBundle\Advertiser\Mapper\AdvertiserOfferMapper;
use Recruitment\DomainBundle\Advertiser\Mapper\AdvertiserOneMapper;
use Recruitment\DomainBundle\Advertiser\Mapper\AdvertiserTwoMapper;
use Recruitment\DomainBundle\Advertiser\Mapper\MapperFactory;
use Recruitment\DomainBundle\Curl\Curl;

class AdvertiserService
{
    private $curl;
    private $offerService;

    public function __construct(
        Curl $curl,
        OfferService $offerService
    ) {
        $this->curl = $curl;
        $this->offerService = $offerService;
    }

    public function persistOffers(int $advertiserId)
    {
        $data = $this->fetch($advertiserId);

        $mapper = (new MapperFactory())->build($advertiserId);
        $offers = [];
        foreach ($data as $offerJson) {
            try {
                $offers[] = $mapper->map($offerJson);
            } catch (\Throwable $e) {
                continue;
                //log error
            }
        }

        if (!$offers) {
            return;
        }

        // TODO: another way would be to expose a transaction manager here and act when something fails
        try {
            $this->offerService->persistOffers($offers);
        } catch (\Throwable $e) {
            // log error
        }
    }

    public function fetch(int $advertiserId)
    {
        return $this->curl->fetchAdvertiserOffers($advertiserId);
    }
}