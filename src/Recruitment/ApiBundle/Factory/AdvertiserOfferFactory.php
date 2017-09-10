<?php

namespace Recruitment\ApiBundle\Factory;

use Recruitment\ApiBundle\Util\Advertisers\BaseAdvertiserOffer;
use Recruitment\ApiBundle\Util\Advertisers\AdvertiserOffer1;
use Recruitment\ApiBundle\Util\Advertisers\AdvertiserOffer2;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 13:19
 */
class AdvertiserOfferFactory
{

  /**
   * @param int $advertiserId
   * @param array $offerData
   * @return mixed
   * @throws Exception
   */
  public static function build(int $advertiserId, array $offerData ) : BaseAdvertiserOffer
  {

    //throw exception if we have an invalid advertiser id
    if (!is_numeric($advertiserId)) {
      throw new \InvalidArgumentException('advertiser_id.invalid');
    }

    //compose the class name dynamically
    $offerClassName = '\Recruitment\ApiBundle\Util\Advertisers\AdvertiserOffer' . $advertiserId;

    if (!class_exists($offerClassName)) {
      throw new Exception("advertiser_id.not_handled");
    }

    return new $offerClassName($offerData);

  }



}