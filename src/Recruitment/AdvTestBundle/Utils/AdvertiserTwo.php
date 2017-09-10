<?php
/**
 * Created by PhpStorm.
 * User: msalestrial
 * Date: 04/09/2017
 * Time: 16:02
 */

namespace Recruitment\AdvTestBundle\Utils;

class AdvertiserTwo extends AbstractAdvertiser
{
    const POINTS_EXEC_RATE = 1000;

    public function setPayout($points)
    {
        $this->payout = $points / self::POINTS_EXEC_RATE;
    }
    
    /**
     * @param array $attributes
     */
    public function init(array $attributes)
    {
        $this->setPlatform($attributes['app_details']['platform']);
        $this->setPayout($attributes['campaigns']['points']);
        $this->setCountry(
            $attributes['campaigns']['countries'][0]
        );
        $this->setName($attributes['name']);
    }

}