<?php

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="offers")
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(length=32, unique=true) */
    protected $application_id;

    /**
     * @ORM\Column(name="country", type="string", length=3, nullable=true)
     */
    public $country;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    public $payout;

    /**
     * @ORM\Column(name="currency", type="string", length=20)
     */
    public $currency;

    /** @ORM\Column(type="string", columnDefinition="ENUM('Android', 'iOS')") */
    public $platform;


    public function setApplicationId(string $offer_json) : void
    {
        $this->application_id = md5($offer_json . time());
    }
}