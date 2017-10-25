<?php

namespace Recruitment\ApiBundle\Service;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Intl\Intl;

class OfferService
{
    protected $routes = [
        '/advertiser/{advertiserId}/offers',
        '/advertiser/{advertiserId}/offer/{offerId}'
    ];

    protected $guzzle_client;

    public function __construct(ClientInterface $client)
    {
        $this->guzzle_client = $client;
    }

    public function get(string $url) : string
    {
        try {
            $response = $this->guzzle_client->request('GET', $url);
            return $response->getBody();
        } catch (\Exception $exception) {
        }
    }

    public function getCountryCode(string $country) : string
    {
        return Intl::getRegionBundle()->getLocales();
    }


    public function getRoute(string $base_url, int $advertiser_id, int $offer_id = 0) : string
    {
        $route = $this->routes[$offer_id];
        $route = str_replace('{advertiserId}', $advertiser_id, $route);
        $route = str_replace('{offerId}', $offer_id, $route);

        return $base_url . $route;
    }
}
