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
        return json_decode(
            "[{\"id\":2,\"advertiser_id\":2,\"app_details\":{\"bundle_id\":\"1218137964\",\"platform\":\"iOS\",\"store_rating\":4.5,\"total_ratings\":10,\"category\":\"Games - Casual\",\"size\":\"251.0 MB\",\"developer\":\"NCSOFT\",\"version\":\"1.0.6\"},\"campaigns\":{\"cid\":\"12343623\",\"click_url\":\"http:\/\/exampleclickurl.com\",\"global\":false,\"countries\":[\"BRA\"],\"points\":520,\"min_os_version\":null,\"device_id_required\":false}},{\"id\":1,\"advertiser_id\":2,\"app_details\":{\"bundle_id\":\"com.amazon.tahoe\",\"platform\":\"Android\",\"store_rating\":4.1,\"total_ratings\":921,\"category\":\"Entertainment\",\"size\":\"N\/A\",\"developer\":\"Amazon Mobile LLC\",\"version\":\"FreeTimeApp-aosp_v3.9_Build-1.0.83.18.9674\"},\"campaigns\":{\"cid\":\"1244775\",\"click_url\":\"http:\/\/exampleclickurl.com\",\"global\":false,\"countries\":[\"USA\"],\"points\":1930,\"min_os_version\":\"5.0\",\"device_id_required\":false}},{\"id\":3,\"advertiser_id\":2,\"app_details\":{\"bundle_id\":\"com.ncsoft.aramipuzzventure\",\"platform\":\"Android\",\"store_rating\":4.5,\"total_ratings\":2770,\"category\":\"Games - Casual Management\",\"size\":\"N\/A\",\"developer\":\"NCSOFT Corporation\",\"version\":\"1.0.6\"},\"campaigns\":{\"cid\":\"13213622\",\"click_url\":\"http:\/\/exampleclickurl.com\",\"global\":false,\"countries\":[\"IND\"],\"points\":330,\"min_os_version\":\"4.1\",\"device_id_required\":false}}]",
            true
        );
        return $this->curl->fetchAdvertiserOffers($advertiserId);
    }
}