<?php

namespace Recruitment\ApiBundle\Interfacing;

/**
 * Interface AdvertiserInterface
 *
 * Define the contract of advertiser class
 *
 * @package Recruitment\ApiBundle\Controller\Interfacing
 */
interface AdvertiserInterface
{
    /**
     * Take advertisers inputs and return a uniformed response
     *
     * @param integer $advertiserId
     * @param array $content
     * @return array
     */
    function standardize(int $advertiserId, array $content);
}