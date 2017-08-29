<?php

namespace Recruitment\ApiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class Country
{
    /** @ORM\Column(type="string") */
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
        if (!preg_match('/^[A-Z]{2,3}$/', $country)) {
            throw new \InvalidArgumentException();
        }

        if(strlen($country)==3) {
            substr_replace($country, "", -1);
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