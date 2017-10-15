<?php

namespace Recruitment\ApiBundle\Service;


class ConversionService
{
    public static function convertPayout(int $payout, float $rate)
    {
        return $payout * $rate;
    }
}