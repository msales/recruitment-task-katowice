<?php

namespace Recruitment\ApiBundle\Service;

//Better way is the have rates table or at least a field
class AdvertiserRateService
{
    protected $rates = [
        2 => 0.001
    ];

    protected $default = 0;

    //Better way to have a table with currencies
    //have a relationship and refer to them via ID
    protected $currency = 'USD';

    public function getRate(int $advertiser_id) : float
    {
        return isset($this->rates[$advertiser_id]) ?
            $this->rates[$advertiser_id] :
            $this->default;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}