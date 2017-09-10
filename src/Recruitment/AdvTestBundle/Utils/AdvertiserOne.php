<?php
/**
 * Created by PhpStorm.
 * User: msalestrial
 * Date: 04/09/2017
 * Time: 16:02
 */

namespace Recruitment\AdvTestBundle\Utils;

class AdvertiserOne extends AbstractAdvertiser
{
    
    /**
     * @param array $attributes
     */
    public function init(array $attributes)
    {
        $this->setPlatform($attributes['mobile_platform']);
        $this->setPayout($attributes['payout_amount']); //@todo check on the currency
        $this->setCountry(
            $attributes['countries'][0]
        ); //@todo relation with the entity country -> insert the managing of the different iso code
        $this->setName($attributes['name']);
    }
    
}