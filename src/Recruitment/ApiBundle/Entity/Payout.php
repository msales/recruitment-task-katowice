<?php
namespace Recruitment\ApiBundle\Entity;

/** @ORM\Embeddable() */
class Payout
{
/** @Column(type = "float") */
private $payout;

    /**
     * @var
     */
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
    public function payout()
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