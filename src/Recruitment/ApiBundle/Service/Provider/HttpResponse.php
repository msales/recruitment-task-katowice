<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 15:02
 */

namespace Recruitment\ApiBundle\Service\Provider;


class HttpResponse
{

  private $statusCode;

  private $bodyContents;


  /**
   * @param int $statusCode
   * @param string $body
   */
  public function __construct(int $statusCode, string $bodyContent){
    $this->statusCode = $statusCode;
    $this->bodyContents = $bodyContent;
  }

  /**
   * @return int
   */
  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  /**
   * @param int $statusCode
   */
  public function setStatusCode(int $statusCode)
  {
    $this->statusCode = $statusCode;
  }

  /**
   * @return string
   */
  public function getBodyContents(): string
  {
    return $this->bodyContents;
  }

  /**
   * @param string $bodyContents
   */
  public function setBodyContents(string $bodyContents)
  {
    $this->bodyContents = $bodyContents;
  }



}