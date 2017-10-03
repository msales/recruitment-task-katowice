<?php

namespace Recruitment\ApiBundle\Util\Advertisers;

use \Recruitment\ApiBundle\Util\Advertisers\Abstraction\AbstractAdvertiser;

/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 03/10/2017
 * Time: 02:55
 */
class Advertiser2 extends AbstractAdvertiser
{
  const CONVERSION = 0.001;

  /**
   * @return mixed
   */
  public function getApplicationId()
  {
    return $this->data["app_details"]["bundle_id"];
  }

  /**
   * @return mixed
   */
  public function getCountry()
  {
    return $this->data["campaigns"]["countries"][0];
  }

  /**
   * @return mixed
   */
  public function getPayout()
  {
    return $this->data["campaigns"]["points"]*self::CONVERSION;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->data["app_details"]["developer"];
  }

  /**
   * @return int
   */
  public function getPlatform()
  {
    return $this->convertPlatform(
      $this->data["app_details"]["platform"]
    );
  }
}