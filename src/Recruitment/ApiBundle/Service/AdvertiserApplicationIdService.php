<?php

namespace Recruitment\ApiBundle\Service;

class AdvertiserApplicationIdService
{
    public static function encode(string $applicationId) : string
    {
        md5($applicationId);
    }
}