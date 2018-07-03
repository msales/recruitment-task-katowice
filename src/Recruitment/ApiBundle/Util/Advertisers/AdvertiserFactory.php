<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 03/10/2017
 * Time: 03:02
 */

namespace Recruitment\ApiBundle\Util\Advertisers;

use Recruitment\ApiBundle\Util\Advertisers\Abstraction\AbstractAdvertiser;

class AdvertiserFactory
{
  /**
   * @param int $advertiserId
   * @param array $data
   * @return AbstractAdvertiser
   */
  public static function getInstance($advertiserId, array $data)
  {
    switch ($advertiserId) {
      case 1:
        return new Advertiser1($data);
        break;
      case 2:
        return new Advertiser2($data);
        break;
    }
  }
}