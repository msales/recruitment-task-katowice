<?php

namespace Recruitment\ApiBundle\Service;

use Recruitment\ApiBundle\Service\Provider\HttpClient;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 12:38
 */
class OffersApiService
{

  /**
   * Routes for this api service
   */
  CONST GET_ADVERTISER_OFFERS_ROUTE = "/advertiser/%s/offers";
  CONST GET_OFFER_BY_ID_ROUTE = "/advertiser/%s/offers/%s";

  private $httpClient;

  /**
   * ApiService constructor.
   */
  public function __construct(HttpClient $httpClient){
    $this->httpClient = $httpClient;
  }

  /**
   *
   * Retrieves the offers for the given ADVERTISER ID and returns the offers data as
   * an associative array
   *
   * @param int $advertiserId
   * @return mixed
   * @throws \Exception
   */
  public function getOffersByAdvertiserId(int $advertiserId) : array
  {
    $response = $this->httpClient->get(sprintf(self::GET_ADVERTISER_OFFERS_ROUTE, $advertiserId));

    if ($response->getStatusCode() !== 200){
      throw new \Exception("api_service.get_offers.failed ", $response->getStatusCode());
    }

    return json_decode($response->getBodyContents(),true);

  }


  /**
   * Retrieves offer with given OFFER ID for the given ADVERTISER ID
   * Data is returned as an associative array
   *
   * @param int $advertiserId
   * @param int $offerId
   * @return array
   * @throws \Exception
   */
  public function getOffersByOfferId(int $advertiserId, int $offerId) : array
  {

    $response = $this->httpClient->get(sprintf(self::GET_ADVERTISER_OFFERS_ROUTE, $advertiserId, $offerId));

    if ($response->getStatusCode() !== 200){
      throw new \Exception("api_service.get_offers.failed ", $response->getStatusCode());
    }

    return json_decode($response->getBodyContents(),true);

  }

}