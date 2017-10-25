<?php

namespace Recruitment\ApiBundle\Interfaces;


interface RateInterface
{
    public function getRate(int $advertiserId) : float;
    public function getCurrency() : string;
}