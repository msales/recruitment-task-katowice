<?php
/**
 * EnumPlatformType.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2017-09-10
 * @since     TODO ${VERSION}
 * @package   Recruitment\Doctrine\DBAL\Types
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */

namespace Recruitment\Doctrine\DBAL\Types;

/**
 * Class EnumPlatformType
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2017-09-10
 * @since     TODO ${VERSION}
 * @package   Recruitment\Doctrine\DBAL\Types
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */
class EnumPlatformType extends EnumType
{
    /**
     * @var string
     */
    protected $name = 'enumplatform';
    /**
     * @var array
     */
    protected $values = ['Android', 'iOS'];
}