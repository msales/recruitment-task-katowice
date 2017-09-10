<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 03/09/2017
 * Time: 14:27
 */

namespace Recruitment\ApiBundle\Util\Advertisers;


/**
 * @package Recruitment\ApiBundle\Util
 */
class AdvertiserOffer2 extends BaseAdvertiserOffer
{

  /**
   * Returns the countries for this advertiser offer
   *
   * @return string
   */
  public function getCountries() : array
  {
    return $this->offerData['campaigns']['countries'];
  }

  /**
   * Returns the offer name for this advertiser offer
   *
   * @return string
   */
  public function getOfferName() : string
  {
    return $this->offerData['app_details']['category'];
  }

  /**
   * @return int
   */
  public function getCampaignId() : int
  {

    return $this->offerData['campaigns']['cid'];

  }

  /**
   * @return string
   */
  public function getPlatform(): string
  {
    return $this->offerData['app_details']['platform'];
  }

  /**
   * @return string
   */
  public function getPayoutCurrency() : string
  {
    return "USD";
  }

  /**
   * @return float
   */
  public function getPayout() : float {
    return $this->offerData['campaigns']['points'];
  }






}