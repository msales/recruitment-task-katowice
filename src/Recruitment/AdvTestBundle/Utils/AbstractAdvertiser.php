<?php
/**
 * Created by PhpStorm.
 * User: msalestrial
 * Date: 04/09/2017
 * Time: 16:05
 */

namespace Recruitment\AdvTestBundle\Utils;

abstract class AbstractAdvertiser
{

    protected $country;

    protected $payout;

    protected $name;

    protected $platform;

    
    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = \Recruitment\AdvTestBundle\Utils\ConversionMetrics::convertCountryIsoCodeFrom3To2($country);
    }

    //region getters/setters
    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * @param mixed $payout
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
    //endregion

    public function __construct()
    {

    }
    
    abstract function init(array $attributes);

}