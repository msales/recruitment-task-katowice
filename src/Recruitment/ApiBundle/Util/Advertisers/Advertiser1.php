<?php

namespace Recruitment\ApiBundle\Util\Advertisers;

use \Recruitment\ApiBundle\Util\Advertisers\Abstraction\AbstractAdvertiser;

/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 03/10/2017
 * Time: 02:55
 */
class Advertiser1 extends AbstractAdvertiser
{

  /**
   * @return mixed
   */
  public function getApplicationId()
  {
    return $this->data["mobile_app_id"];
  }

  /**
   * @return mixed
   */
  public function getCountry()
  {
    return $this->data["countries"][0];
  }

  /**
   * @return mixed
   */
  public function getPayout()
  {
    return $this->data["payout_amount"];
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->data["name"];
  }

  /**
   * @return int
   */
  public function getPlatform()
  {
    return $this->convertPlatform(
      $this->data["mobile_platform"]
    );
  }
}