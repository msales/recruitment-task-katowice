<?php

namespace Recruitment\ApiBundle\Service;

//Better way is the have rates table or at least a field
class AdvertiserRateService
{
    protected static $rates = [
        2 => 0.001
    ];

    protected static $default = 0;

    //Better way to have a table with currencies
    //have a relationship and refer to them via ID
    const CURRENCY = 'USD';

    public static function getRate(int $advertiser_id) : float
    {
        return isset(self::$rates[$advertiser_id]) ?
            self::$rates[$advertiser_id] :
            self::$default;
    }
}