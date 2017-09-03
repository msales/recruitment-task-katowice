<?php


/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 02/09/2017
 * Time: 11:10
 */

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Offer
 * @package Recruitment\ApiBundle\Entity
 * @ORM\Table(name="offer")
 * @ORM\Entity()
 */
class Offer
{

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $offferId;

  /**
   * @var int
   *
   * @ORM\Column(name="application_id", type="integer", unique=true)
   */
  private $applicationId;

  /**
    * @var String
    *
    * @ORM\Column (type="string",length=3,name="country_code")
    */
  private $country;

  /**
   * @var float
   *
   * @ORM\Column(type="float")
   */
  private $payout;

  /**
   * @var string
   *
   * @ORM\Column(type="string", length=75)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(type="string", length=15, columnDefinition="ENUM('Android', 'IOS')")
   */
  private $platform;

  /**
   * @var int
   *
   * @ORM\Column(name="advertiser_id", type="integer")
   */
  private $advertiserId;

  /**
   * @return int
   */
  public function getOffferId(): int
  {
    return $this->offferId;
  }

  /**
   * @param int $offferId
   */
  public function setOffferId(int $offferId)
  {
    $this->offferId = $offferId;
  }



  /**
   * @return int
   */
  public function getApplicationId(): int
  {
    return $this->applicationId;
  }

  /**
   * @param int $applicationId
   */
  public function setApplicationId(int $applicationId)
  {
    $this->applicationId = $applicationId;
  }

  /**
   * @return string
   */
  public function getCountry(): string
  {
    return $this->country;
  }

  /**
   * @param string $country
   */
  public function setCountry(string $country)
  {

    //if we do not have a valid country code format that adheres to
    //ISO 3166-1 alpha-2 .. we abort
    if (!preg_match('/^[A-Z]{2,3}$/', $country)) {
      throw new \InvalidArgumentException("country_code.invalid");
    }

    $this->country = $country;
  }

  /**
   * @return float
   */
  public function getPayout(): float
  {
    return $this->payout;
  }

  /**
   * @param float $payout
   */
  public function setPayout(float $payout)
  {
    $this->payout = $payout;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name)
  {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getPlatform(): string
  {
    return $this->platform;
  }

  /**
   * @param string $platform
   */
  public function setPlatform(string $platform)
  {
    $this->platform = $platform;
  }

  /**
   * @return int
   */
  public function getAdvertiserId(): int
  {
    return $this->advertiserId;
  }

  /**
   * @param int $advertiserId
   */
  public function setAdvertiserId(int $advertiserId)
  {
    $this->advertiserId = $advertiserId;
  }


}

