<?php

namespace Recruitment\ApiBundle\Interfaces;

use Recruitment\ApiBundle\Entity\Map;

interface MapperInterface
{
    public function map(array $offer, Map $map) : array;
}