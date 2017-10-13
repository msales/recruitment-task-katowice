<?php

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Money\Currency;
use Money\Money;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="Recruitment\ApiBundle\Repository\OfferRepository")
 */
class Offer
{
    use ORMBehaviors\Timestampable\Timestampable,
        ORMBehaviors\SoftDeletable\SoftDeletable;

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
     * @ORM\Column(name="application_id", type="string", unique=true)
     */
    private $applicationId;

    /**
     * @var string
     *
     *
     * @Assert\Country()
     * @ORM\Column(name="country", type="simple_array", length=3)
     */
    private $country;

    /**
     * @var float
     *
     * @ORM\Column(name="payout_amount", type="float")
     */
    private $payoutAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="payout_currency", type="string", length=64)
     */
    private $payoutCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="platform", columnDefinition="ENUM('Android', 'iOS')")
     */
    private $platform;


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
     * get Payout
     *
     * @return Money
     */
    public function getPayout()
    {
        if (!$this->payoutCurrency) {
            return null;
        }
        if (!$this->payoutAmount) {
            return new Money(0, new Currency($this->payoutCurrency));
        }
        return new Money($this->payoutAmount, new Currency($this->payoutCurrency));
    }

    /**
     * Set Payout
     *
     * @param Money $payout
     * @return Offer
     */
    public function setPayout(Money $payout)
    {
        $this->payoutAmount = $payout->getAmount();
        $this->payoutCurrency = $payout->getCurrency()->getName();

        return $this;
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
     * @param array $platform
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
     * @return array
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}

