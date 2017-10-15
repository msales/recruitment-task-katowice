<?php

namespace Recruitment\DomainBundle\Common;

abstract class Enum implements \JsonSerializable
{
    const VALUES = [];

    private $value;

    final public function __construct($value)
    {
        if (!in_array($value, static::VALUES, true)) {
            throw new \InvalidArgumentException($value);
        }
        $this->value = $value;
    }

    final public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }

    final public static function get($name)
    {
        $constant = static::class.'::'.strtoupper($name);
        if (!defined($constant)) {
            throw new \InvalidArgumentException();
        }

        return new static(constant($constant));
    }

    final public static function getAll()
    {
        $all = [];
        foreach (static::VALUES as $value) {
            $all[] = new static($value);
        }

        return $all;
    }

    public static function __callStatic($methodName, array $arguments)
    {
        return new static($methodName);
    }
}
