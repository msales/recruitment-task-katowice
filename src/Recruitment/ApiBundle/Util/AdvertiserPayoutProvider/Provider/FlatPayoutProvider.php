<?php

namespace Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Provider;

use Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Abstraction\AbstractPayoutProvider;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 18:45
 */
class FlatPayoutProvider  extends AbstractPayoutProvider
{

  /**
   * @param float $payout
   * @return float
   */
  function getPayoutAmount(float $payout) : float
  {
    return $payout;
  }

}