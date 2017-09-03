<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:42
 */

namespace Recruitment\ApiBundle\Util\Advertisers;


/**
 * Class Advertiser1
 * @package Recruitment\ApiBundle\Util
 */
class Advertiser1 extends BaseAdvertiser
{

  /**
   * Advertiser1 constructor.
   *
   * @param array $offerData
   */
  public function __construct(array $offerData)
  {
    //invoke parent constructor
    parent::__construct($offerData);
  }

  /**
   * Returns the country for this advertiser offer
   *
   * @return string
   */
  public function getCountry() : string
  {
    return $this->offerData['countries'][0];
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

  /**
   * @return float
   */
  public function getPayoutAmount() : float
  {
    return $this->offerData['payout_amount'];
  }


}