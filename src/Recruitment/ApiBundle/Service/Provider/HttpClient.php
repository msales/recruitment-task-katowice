<?php

namespace Recruitment\ApiBundle\Service\Provider;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 14:25
 */
abstract class HttpClient
{

  //the base url
  protected $baseUrl;

  /**
   *
   * Do not allow creation of new instances. Use the init() instead
   *
   * HttpClientProvider constructor.
   */
  public function __construct(string $baseUrl){
    $this->baseUrl = $baseUrl;
    $this->init();
  }

  /**
   *
   * Initializes the client
   *
   * @return mixed
   */
  protected abstract function init();

  /**
   * Get Request
   *
   * @return mixed
   */
  public abstract function get(string $routeName) : HttpResponse;


}