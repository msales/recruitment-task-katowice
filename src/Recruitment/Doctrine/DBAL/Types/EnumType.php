<?php
/**
 * EnumType.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2017-09-10
 * @since     TODO ${VERSION}
 * @package   Recruitment\Doctrine\DBAL\Types
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */

namespace Recruitment\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class EnumType
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2017-09-10
 * @since     TODO ${VERSION}
 * @package   Recruitment\Doctrine\DBAL\Types
 * @copyright Copyright (c) 2017 Panagiotis Vagenas
 */
abstract class EnumType extends Type
{
    /**
     * The name of the type
     *
     * @var string
     */
    protected $name;
    /**
     * Allowed values
     *
     * @var array
     */
    protected $values = array();

    /**
     * @inheritdoc
     *
     * @param array $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = array_map(
            function ($val) {
                return "'".$val."'";
            },
            $this->values
        );

        return "ENUM(".implode(", ", $values).")";
    }

    /**
     * @inheritdoc
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * @inheritdoc
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->values)) {
            throw new \InvalidArgumentException("Invalid '".$this->name."' value.");
        }

        return $value;
    }

    /**
     * @inheritdoc
     *
     * @param AbstractPlatform $platform
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see    EnumType::$name
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @see EnumType::$values
     * @since TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getValues()
    {
        return $this->values;
    }
}