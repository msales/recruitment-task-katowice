<?php
namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class PayoutValueObject
{

    /** @ORM\Column(type="integer") */
    private $payout;

    /** @ORM\Column(type="string") */
    private $currency;

    /**
     * Payout constructor.
     * @param $amount
     * @param Currency $currency
     */
    public function __construct(PayoutInterface $amount)
    {
        $this->setPayout($amount->getPayout());
        $this->setCurrency($amount->getCurrency());
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