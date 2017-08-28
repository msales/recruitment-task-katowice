<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Entity\Currency;
use Recruitment\ApiBundle\Entity\Payout;

class PayoutTest extends TestCase
{
    /**
     * @test
     */

    public function it_calculates_the_payout_amount()
    {
        $payout = new Payout(10, new Currency('USD'));

        $this->assertEquals('0.01', $payout->payout());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_on_invalid_data()
    {
        $this->expectException(\InvalidArgumentException::class);
        $payout = new Payout('sfsdf', new Currency('USD'));
    }
}