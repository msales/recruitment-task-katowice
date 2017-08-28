<?php
namespace Recruitment\ApiBundle\Entity;

/** @ORM\Embeddable() */
class Payout
{
/** @Column(type = "float") */
private $payout;

private $currency;

    public function __construct($amount, Currency $currency)
    {
        $this->setPayout($amount);
        $this->setCurrency($currency);
    }
    private function setPayout($amount)
    {
        if(!is_numeric($amount)) throw new \InvalidArgumentException('The amount is not valid');

        $this->payout = number_format($amount/1000, 2);
    }
    private function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }
    public function payout()
    {
        return $this->payout;
    }
    public function currency()
    {
        return $this->currency;
    }

}