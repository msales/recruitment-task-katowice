<?php
namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class Payout
{
    /** @ORM\Column(type = 'integer') */
    private $payout;
    /** @ORM\Column(type='string') */
   private $currency;

    /**
     * Payout constructor.
     * @param $amount
     * @param Currency $currency
     */
    public function __construct($amount, Currency $currency)
    {
        $this->setPayout($amount);
        $this->setCurrency($currency);
    }

    /**
     * @param $amount
     */
    private function setPayout($amount)
    {
        if(!is_numeric($amount)) throw new \InvalidArgumentException('The amount is not valid');

        $this->payout = number_format($amount/1000, 2);
    }

    /**
     * @param Currency $currency
     */
    private function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * @return mixed
     */
    public function currency()
    {
        return $this->currency;
    }

}