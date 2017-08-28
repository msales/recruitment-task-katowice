<?php

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Recruitment\ApiBundle\Repository\OfferRepository;
use Recruitment\ApiBundle\Entity\Country;
use Recruitment\ApiBundle\Entity\Payout;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="Recruitment\ApiBundle\Repository\OfferRepository")
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
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="application_id", type="integer", unique=true)
     */
    private $applicationId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=255, columnDefinition="ENUM('Android', 'IOS')")
     */
    private $platform;

    /**
     * @var int
     *
     * @ORM\Column(name="advertiser_id", type="integer")
     */
    private $advertiserId;

    /**
     * @ORM\Embedded(class = "\Recruitment\ApiBundle\Entity\Country")
     */
    private $country;

    /**
     * @ORM\Embedded(class = "\Recruitment\ApiBundle\Entity\Payout")
     */
    private $payout;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set applicationId
     *
     * @param integer $applicationId
     *
     * @return Offer
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;

        return $this;
    }

    /**
     * Get applicationId
     *
     * @return int
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Offer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set platform
     *
     * @param string $platform
     *
     * @return Offer
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set advertiserId
     *
     * @param integer $advertiserId
     *
     * @return Offer
     */
    public function setAdvertiserId($advertiserId)
    {
        $this->advertiserId = $advertiserId;

        return $this;
    }

    /**
     * Get advertiserId
     *
     * @return int
     */
    public function getAdvertiserId()
    {
        return $this->advertiserId;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Offer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set payout
     *
     * @param string $payout
     *
     * @return Offer
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * Get payout
     *
     * @return string
     */
    public function getPayout()
    {
        return $this->payout;
    }
}

