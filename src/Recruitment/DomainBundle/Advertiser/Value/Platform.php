<?php

namespace Recruitment\DomainBundle\Advertiser\Value;

use Recruitment\DomainBundle\Common\Enum;

/**
 * @method Platform Android()
 * @method Platform iOS()
 */
class Platform extends Enum
{
    const VALUES = ['Android', 'iOS'];
}