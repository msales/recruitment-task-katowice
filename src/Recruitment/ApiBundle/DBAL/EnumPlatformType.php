<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\DBAL;

class EnumPlatformType extends EnumType
{
    protected $name = 'enum_platform';
    protected $values = array('Android', 'iOS');
}