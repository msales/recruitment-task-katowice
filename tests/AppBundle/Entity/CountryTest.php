<?php

namespace Tests\AppBundle\Entity;

use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Entity\Country;

class CountryTest extends TestCase
{
    /**
     * @test
     */
    public function it_sets_a_country_code()
    {
        $country = new Country('GR');
        $this->assertEquals('GR',$country->getCountry());
    }

    /**
     * @test
     */
    public function it_throws_an_exception_on_invalid_code()
    {
        $this->expectException(\InvalidArgumentException::class);
        $country = new Country('asdsa');
    }
}