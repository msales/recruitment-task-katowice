<?php
/**
 * Offer.php description
 *
 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date 2017-09-10
 * @since TODO ${VERSION}
 * @package Recruitment\ApiBundle\Entity
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Recruitment\Doctrine\DBAL\Types\EnumPlatformType;

/**
 * Class Offer
 *
 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date 2017-09-10
 * @since TODO ${VERSION}
 * @package Recruitment\ApiBundle\Entity
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
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
     * @ORM\Column(name="country", type="string", length=2)
     */
    private $country;

    /**
     * @var float
     *
     * @ORM\Column(name="payout", type="float")
     */
    private $payout;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var EnumPlatformType
     *
     * @ORM\Column(name="platform", type="enumplatform")
     */
    private $platform;


    /**
     * Get id
     *
     * @return int
     * @codeCoverageIgnore
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
     * @codeCoverageIgnore
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
     * @codeCoverageIgnore
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Offer
     * @codeCoverageIgnore
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
     * @codeCoverageIgnore
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set payout
     *
     * @param float $payout
     *
     * @return Offer
     * @codeCoverageIgnore
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * Get payout
     *
     * @return float
     * @codeCoverageIgnore
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Offer
     * @codeCoverageIgnore
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
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set platform
     *
     * @param EnumPlatformType $platform
     *
     * @return Offer
     * @codeCoverageIgnore
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return EnumPlatformType
     * @codeCoverageIgnore
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}