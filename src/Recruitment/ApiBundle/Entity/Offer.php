<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/2/17
 * Time: 3:57 PM
 *
 * this is the entity class for the offer objects
 * we are using doctrine to create the table in the db
 * and manage the interaction with the db
 */

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="offer")
 */
class Offer
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $application_id;

  /**
   * @ORM\Column(type="string",length=2)
   */
  private $country;

  /**
   * @ORM\Column(type="decimal",scale=2)
   */
  private $payout;

  /**
   * @ORM\Column(type="string")
   */
  private $name;

  /**
   * @ORM\Column(type="string",columnDefinition="enum('Android', 'iOS')")
   */
  private $platform;

  /*
   * getter methods
   */
  /**
   * @return integer
   */
  public function getApplicationId()
  {
    return $this->application_id;
  }

  /**
   * @return string
   */
  public function getCountry()
  {
    return $this->country;
  }

  /**
   * @return float
   */
  public function getPayout()
  {
    return floatval($this->payout);
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getPlatform()
  {
    return $this->platform;
  }

  /*
   * setter methods
   */
  /**
   * @param string $country
   */
  public function setCountry($country)
  {
    $this->country = $country;
  }

  /**
   * @param float $payout
   */
  public function setPayout($payout)
  {
    $this->payout = sprintf("%.2f",$payout);
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @param string $platform
   */
  public function setPlatform($platform)
  {
    $this->platform = $platform;
  }

  /**
   * @return array
   */
  public function toArray()
  {
    return array(
      "application_id" => $this->application_id,
      "name" => $this->name,
      "payout" => $this->payout,
      "country" => $this->country,
      "platform" => $this->platform
    );
  }
}