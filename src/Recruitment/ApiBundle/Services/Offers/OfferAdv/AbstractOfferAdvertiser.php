<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:49
 */

namespace Recruitment\ApiBundle\Services\Offers\OfferAdv;

abstract class AbstractOfferAdvertiser implements OfferAdvertiserInterface
{
    protected $countryNormalizer;

    /**
     * @param $countryNormalizer
     */
    public function __construct($countryNormalizer)
    {
        $this->countryNormalizer = $countryNormalizer;
    }
}