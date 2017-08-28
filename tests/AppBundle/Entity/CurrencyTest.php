<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Entity\Currency;

class CurrencyTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_a_currency()
    {
        $cur = new Currency('USD');
        $this->assertEquals('USD', $cur->isoCode());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_wrong_data_is_entered()
    {
        $this->expectException(\InvalidArgumentException::class);
        $cur = new Currency('sfsdf');
    }
}