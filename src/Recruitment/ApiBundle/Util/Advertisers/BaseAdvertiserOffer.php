<?php

namespace Recruitment\ApiBundle\Util\Advertisers;

use Recruitment\ApiBundle\Util\AdvertiserPayoutProvider\Abstraction\AbstractPayoutProvider;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 13:17
 */
abstract class BaseAdvertiserOffer implements AdvertiserOfferInterface
{

  /**
   * @var array
   */
  protected $offerData;

  /**
   * Sets the offer data
   *
   * @param array $offerData
   */
  public function __construct(array $offerData){
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


}