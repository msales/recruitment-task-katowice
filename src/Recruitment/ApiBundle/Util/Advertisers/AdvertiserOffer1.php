<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:42
 */

namespace Recruitment\ApiBundle\Util\Advertisers;


/**
 * @package Recruitment\ApiBundle\Util
 */
class AdvertiserOffer1 extends BaseAdvertiserOffer
{


  /**
   * Returns the country for this advertiser offer
   *
   * @return string
   */
  public function getCountries() : array
  {
    return $this->offerData['countries'];
  }

  /**
   * Returns the offer name for this advertiser offer
   *
   * @return string
   */
  public function getOfferName() : string
  {
    return $this->offerData['name'];
  }

  /**
   * @return int
   */
  public function getCampaignId() : int
  {

    return $this->offerData['campaign_id'];

  }

  /**
   * @return string
   */
  public function getPlatform(): string
  {
    return $this->offerData['mobile_platform'];
  }

  /**
   * @return string
   */
  public function getPayoutCurrency() : string
  {
    return $this->offerData['payout_currency'];
  }

  public function getPayout() : float {
    return $this->offerData['payout_amount'];
  }

}