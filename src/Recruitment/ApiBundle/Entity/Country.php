<?php

namespace Recruitment\ApiBundle\Entity;


/** @ORM\Embeddable() */
class Country
{
    /** @Column(type = "string") */
    private $country;

    public function __construct($country)
    {
        $this->setCountry($country);
    }

    public function setCountry($country)
    {
        if (!preg_match('/^[A-Z]{2}$/', $country)) {
            throw new \InvalidArgumentException();
        }
        $this->country = $country;
    }


    public function getCountry()
    {
        return $this->country;
    }


}