<?php

namespace Recruitment\ApiBundle\Interfaces;

interface AdvertiserApplicationIdInterface
{
    public function encode(string $applicationId) : string;
}