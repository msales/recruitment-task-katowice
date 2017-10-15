<?php

namespace Recruitment\ApiBundle\Service;

use GuzzleHttp\ClientInterface;
use RecursiveIteratorIterator;
use RecursiveArrayIterator;
use Symfony\Component\Intl\Intl;
use Recruitment\ApiBundle\Service\CountryCodeService;

class OfferService
{
    protected static $routes = [
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

    public function getCampaigns(array $response) : array
    {
        if (isset($response['campaigns'])) {
            return [$response['campaigns']];
        }
        return [$response];
    }

    public function getAppDetails(array $response)
    {
        if (isset($response['app_details'])) {
            return $response['app_details'];
        }

        return [];
    }

    public function getPlatform(array $offer) : string
    {
       return static::searchResponse('platform', $offer);
    }

    protected function searchResponse(string $property, array $offer) : string
    {
        $it = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($offer)
        );

        foreach($it as $key => $value) {
            if (preg_match("/{$property}/i", $key)) {
                return $value;
            }
        }

        return '';
    }

    public function getCountryCode(string $country) : string
    {
        return Intl::getRegionBundle()->getLocales();
    }


    public function getRoute(string $base_url, int $advertiser_id, int $offer_id = 0) : string
    {
        $route = static::$routes[$offer_id];
        $route = str_replace('{advertiserId}', $advertiser_id, $route);
        $route = str_replace('{offerId}', $offer_id, $route);

        return $base_url . $route;
    }
}
