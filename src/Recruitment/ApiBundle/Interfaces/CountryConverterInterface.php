<?php

namespace Recruitment\ApiBundle\Interfaces;


interface CountryConverterInterface
{
    public function convertToIso2(string $iso) : string;
}