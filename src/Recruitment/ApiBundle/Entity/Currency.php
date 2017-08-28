<?php
namespace Recruitment\ApiBundle\Entity;

class Currency
{
    /**
     * @var
     */
    private $isoCode;

    /**
     * Currency constructor.
     * @param $IsoCode
     */
    public function __construct($IsoCode)
    {
        $this->setIsoCode($IsoCode);
    }

    /**
     * @param $IsoCode
     */
    private function setIsoCode($IsoCode)
    {
        if (!preg_match('/^[A-Z]{3}$/', $IsoCode)) {
            throw new \InvalidArgumentException();
        }
        $this->isoCode = $IsoCode;
    }

    /**
     * @return mixed
     */
    public function isoCode()
    {
        return $this->isoCode;
    }
}