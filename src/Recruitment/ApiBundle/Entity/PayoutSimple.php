<?php
namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class PayoutSimple implements PayoutInterface
{

    private $payout;

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
    public function setPayout($amount)
    {
        if(!is_numeric($amount)) throw new \InvalidArgumentException('The amount is not valid');

        $this->payout = number_format($amount, 2);
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency)
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
    public function getCurrency()
    {
        return $this->currency;
    }

}