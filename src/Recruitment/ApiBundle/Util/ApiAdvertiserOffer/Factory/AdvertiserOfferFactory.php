<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/4/17
 * Time: 10:31 PM
 */

namespace Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Factory;


/*
 * this is a factory class to return the right advertiser offer based on the input data
 */
use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Abstraction\AbstractAdvertiserOffer;
use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\AdvertiserOffer\Advertiser1Offer;
use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\AdvertiserOffer\Advertiser2Offer;

class AdvertiserOfferFactory
{
  /**
   * @param array $data
   *
   * @return array of AbstractAdvertiserOffer
   */
  public function getAdvertiserOffers(array $data)
  {
    /*
     * based on the advertiser id we call the right sub class
     */
    switch ($data['advertiser_id'])
    {
      case 1:
        return Advertiser1Offer::create($data);
        break;
      case 2:
        return Advertiser2Offer::create($data);
        break;
      default:
        return NULL;
        break;
    }
  }

}