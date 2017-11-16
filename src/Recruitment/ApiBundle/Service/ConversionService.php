<?php

namespace Recruitment\ApiBundle\Service;


class ConversionService
{
    public function convertPayout(int $payout, float $rate)
    {
        return $payout * $rate;
    }
}