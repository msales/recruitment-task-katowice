<?php

namespace Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Provider;

use Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Abstraction\AbstractPayoutProvider;


/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 18:31
 */
class PointsPayoutProvider extends AbstractPayoutProvider
{

  /**
   * IN case we will have different points for different advertiser offers,
   * we will need to map the points to the advertiser in the config file
   */
  CONST POINTS = 10;
  /**
   * @param array $parameters
   *
   * @return array
   */
  function getPayoutAmount(float $payout) : float
  {
    return ($payout / self::POINTS) * 0.01;
  }
}