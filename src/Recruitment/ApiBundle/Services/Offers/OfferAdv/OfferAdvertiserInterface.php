<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:47
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Services\Offers\OfferAdv;

use Recruitment\ApiBundle\Dummies\DummyOffer;

interface OfferAdvertiserInterface
{
    /**
     * @param array $data
     * @return DummyOffer
     */
    public function extractOffer(array $data) : DummyOffer;
}