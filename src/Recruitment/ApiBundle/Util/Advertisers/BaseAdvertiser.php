<?php

namespace Recruitment\ApiBundle\Util\Advertisers;

use Recruitment\ApiBundle\Util\OfferInterface;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:17
 */
abstract class BaseAdvertiser implements OfferInterface
{

  /**
   * @var array
   */
  protected $offerData;


  /**
   *
   * Initializes the class and sets offer data
   *
   * BaseAdvertiser constructor.
   *
   * @param array $offerData
   */
  public function __construct(array $offerData){

    //set the offer data
    $this->offerData = $offerData;

  }

  /**
   * Returns the advertiser id
   *
   * @return int
   */
  public function getAdvertiserId(): int{
    return $this->offerData['advertiser_id'];
  }


  /**
   * @return string
   */
  abstract public function getCountry() : string;

  /**
   * @return string
   */
  abstract public function getOfferName() : string;

  /**
   * @return int
   */
  abstract public function getCampaignId() : int;

  /**
   * @return string
   */
  abstract public function getPlatform(): string;

  /**
   * @return string
   */
  abstract function getPayoutCurrency() : string;

  /**
   * @return float
   */
  abstract function getPayoutAmount(): float;

}