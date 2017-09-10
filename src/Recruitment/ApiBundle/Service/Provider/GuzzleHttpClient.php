<?php

namespace Recruitment\ApiBundle\Service\Provider;

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 14:25
 */
class GuzzleHttpClient extends HttpClient
{

  /**
   * The guzzle client instance
   *
   * @var
   */
  private static $guzzleClient;

  /**
   * Initializes the guzzle client
   */
  protected function init(){

    //initialize guzzle if it hasn't been initialized yet
    if (is_null(self::$guzzleClient)){
      self::$guzzleClient = new Client(['base_uri' => $this->baseUrl]);
    }

  }

  /**
   *
   * Performs a GET using Guzzle
   *
   * @param string $routeName
   * @return HttpResponse
   */
  public function get(string $routeName) : HttpResponse {
    $response = self::$guzzleClient->get($routeName);
    return new HttpResponse($response->getStatusCode(), $response->getBody()->getContents());
  }


}