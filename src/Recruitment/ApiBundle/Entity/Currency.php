<?php
namespace Recruitment\ApiBundle\Entity;

class Currency
{
    private $isoCode;
    public function __construct($IsoCode)
    {
        $this->setIsoCode($IsoCode);
    }
    private function setIsoCode($IsoCode)
    {
        if (!preg_match('/^[A-Z]{3}$/', $IsoCode)) {
            throw new \InvalidArgumentException();
        }
        $this->isoCode = $IsoCode;
    }
    public function isoCode()
    {
        return $this->isoCode;
    }
}