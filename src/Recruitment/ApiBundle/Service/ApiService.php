<?php

namespace Recruitment\ApiBundle\Service;

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 12:38
 */
class ApiService
{

  /**
   * The guzzle client singleton instance
   *
   * @var
   */
  private static $guzzleClient;


  /**
   * ApiService constructor.
   */
  public function __construct(){

    if (!isset(self::$guzzleClient)){
      self::$guzzleClient = new Client(
        ['base_uri' => 'http://msales-katowice-trial.app:8082/']
      );
    }

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
    //compose the endpoint route
    $route = "advertiser/$advertiserId/offers";

    //do the GET
    $response = self::$guzzleClient->get($route);

    //if we do not have a valid respone , throw an exception
    if ($response->getStatusCode() !== 200){
      throw new \Exception("api_service.get_offers.failed ", $response->getStatusCode());
    }

    //return the json decoded data
    return json_decode($response->getBody()->getContents(),true);

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

    //compose the endpoint route
    $route = "advertiser/$advertiserId/offers/$offerId";

    //do the GET
    $response = self::$guzzleClient->get($route);

    //if we do not have a valid respone , throw an exception
    if ($response->getStatusCode() !== 200){
      throw new \Exception("api_service.get_offers.failed ", $response->getStatusCode());
    }

    //return the json decoded data
    return json_decode($response->getBody()->getContents(),true);


  }

}