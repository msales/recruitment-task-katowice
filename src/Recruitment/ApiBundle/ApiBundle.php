<?php

namespace Recruitment\ApiBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiBundle extends Bundle
{
    public function boot()
    {
        Type::addType('enumplatform', 'Recruitment\Doctrine\DBAL\Types\EnumPlatformType');
    }
}