<?php

declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Abstraction;

use Msales\GrapesBundle\Provider\ServiceProvider;

abstract class AbstractPayoutProvider extends ServiceProvider
{
  abstract function getPayoutAmount(float $payout) : float;

}