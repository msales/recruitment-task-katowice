<?php

namespace Recruitment\ApiBundle\Util\Advertisers\Abstraction;

use Recruitment\ApiBundle\Entity\Offer;

/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 03/10/2017
 * Time: 02:48
 */
abstract class AbstractAdvertiser
{
  /** @var array $data */
  protected $data;

  /**
   * @param array $data
   */
  public function setData(array $data)
  {
    $this->data = $data;
  }

  /**
   * @return array
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * AbstractAdvertiser constructor.
   * @param array $data
   */
  public function __construct(array $data)
  {
    $this->setData($data);
  }

  /**
   * @param string $strPlatform
   * @return int
   */
  protected function convertPlatform(string $strPlatform)
  {
    switch (strtolower($strPlatform)) {
      case "android":
        return Offer::PLATFORM_ANDROID;
      case "ios":
        return Offer::PLATFORM_IOS;
    }
  }

  abstract public function getApplicationId();
  abstract public function getCountry();
  abstract public function getPayout();
  abstract public function getName();
  abstract public function getPlatform();
}