<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/4/17
 * Time: 10:06 PM
 */

namespace Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Abstraction;


use Recruitment\ApiBundle\Entity\Offer;

abstract class AbstractAdvertiserOffer
{

  /*
   * data needed to create an offer
   *
   */
  protected $country = NULL;
  protected $payout = NULL;
  protected $name = NULL;
  protected $platform = NULL;

  // flag that indicate if the record is valid
  protected $validOffer = false;

  /**
   * @return Offer
   */
  public function getOffer()
  {
    /*
     * return an entity offer populated with the values in our properties
     */
    $offer = new Offer();
    $offer->setCountry($this->country);
    $offer->setName($this->name);
    $offer->setPayout($this->payout);
    $offer->setPlatform($this->platform);

    return $offer;
  }

  /**
   * @return boolean
   */
  public function isValid()
  {
    return $this->validOffer;
  }

  /*
   * static method that cretes as many advertisers offers as needed from the data passed
   * this method address the issue that the single element can contain multiple countries
   */
  abstract static public function create(array $data);
}