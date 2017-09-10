<?php

namespace Recruitment\ApiBundle\Util\Advertisers;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:26
 */
interface AdvertiserOfferInterface
{

  /**
   * @return string
   */
  public function getCountries() : array;

  /**
   * @return string
   */
  public function getOfferName() : string;

  /**
   * @return int
   */
  public function getCampaignId() : int;

  /**
   * @return string
   */
  public function getPlatform(): string;

  /**
   * @return string
   */
  public function getPayoutCurrency() : string;

  /**
   * @return float
   */
  public function getPayout(): float;

}