<?php

namespace Recruitment\ApiBundle\Util;

/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:26
 */
interface OfferInterface
{

  /**
   * @return string
   */
  public function getCountry() : string;

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
  public function getPayoutAmount(): float;

}