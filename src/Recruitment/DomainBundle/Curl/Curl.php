<?php

namespace Recruitment\DomainBundle\Curl;

use GuzzleHttp\Client;

class Curl extends Client
{
    public function __construct(
        string $baseUrl
    ) {
        parent::__construct([
            "base_uri" => $baseUrl,
            "curl" => [
                CURLOPT_SSL_VERIFYPEER => false
            ]
        ]);
    }

    public function fetchAdvertiserOffers(int $advertiserId)
    {
        $response = $this->request('GET', "/app_dev.php/advertiser/{$advertiserId}/offers");

        return json_decode((string) $response->getBody(), true);
    }
}