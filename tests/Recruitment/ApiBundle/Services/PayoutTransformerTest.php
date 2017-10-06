<?php

namespace Tests\Recruitment\ApiBundle\Services;

use Recruitment\ApiBundle\Entity\OfferInterface;
use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Services\Normalizers\Country\CountryNormalizer;
use Recruitment\ApiBundle\Services\Normalizers\Payout\PayoutTransformerDirect;
use Recruitment\ApiBundle\Services\Normalizers\Payout\PayoutTransformerPoints;
use Recruitment\ApiBundle\Services\Offers\OfferStrategyBuilder;

class PayoutTransformerTest extends TestCase
{
    public function testDirect()
    {
        $payoutTransformer = new PayoutTransformerDirect();
        for($i=0; $i<10; $i++) {
            $value = rand(10000,80000)/10; // simulating currency
            $this->assertEquals($value, $payoutTransformer->getTransformerValue($value));
        }
    }

    public function testPoints()
    {
        $payoutTransformer = new PayoutTransformerPoints();
        for($i=0; $i<10; $i++) {
            $value = rand(10000,80000)/10; // simulating currency
            $this->assertEquals($value, 1000 * $payoutTransformer->getTransformerValue($value));
        }
    }
}
