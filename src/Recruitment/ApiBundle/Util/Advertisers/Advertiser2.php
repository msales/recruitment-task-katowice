<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 03/09/2017
 * Time: 14:27
 */

namespace Recruitment\ApiBundle\Util\Advertisers;


/**
 * Class Advertiser2
 * @package Recruitment\ApiBundle\Util
 */
class Advertiser2 extends BaseAdvertiser
{

  /**
   * Advertiser2 constructor.
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
    return $this->offerData['campaigns']['countries'][0];
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
  public function getPayoutAmount() : float
  {
    //get the number of points
    $points = $this->offerData['campaigns']['points'];

    //10 points = 0.01 USD
    return (float) ($points / 10) * 0.01;


  }






}