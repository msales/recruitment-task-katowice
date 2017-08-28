<?php

namespace Recruitment\ApiBundle\Entity;


/** @ORM\Embeddable() */
class Country
{
    /** @Column(type = "string") */
    private $country;

    /**
     * Country constructor.
     * @param $country
     */
    public function __construct($country)
    {
        $this->setCountry($country);
    }

    /**
     * @param $country
     */
    public function setCountry($country)
    {
        if (!preg_match('/^[A-Z]{2}$/', $country)) {
            throw new \InvalidArgumentException();
        }
        $this->country = $country;
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }


}