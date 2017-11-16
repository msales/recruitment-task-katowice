<?php

namespace Recruitment\ApiBundle\Interfaces;


interface ConverterInterface
{
    public function convertPayout(int $payout, float $rate);
}