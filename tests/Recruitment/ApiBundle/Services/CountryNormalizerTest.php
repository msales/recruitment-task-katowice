<?php

namespace Tests\Recruitment\ApiBundle\Services;

use Recruitment\ApiBundle\Entity\OfferInterface;
use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Services\Normalizers\Country\CountryNormalizer;
use Recruitment\ApiBundle\Services\Offers\OfferStrategyBuilder;

class CountryNormalizerTest extends TestCase
{
    /** @var CountryNormalizer */
    protected $countryNormalizer;

    const BASE = CountryNormalizer::ISO_ALPHA2;

    public function setUp()
    {
        $this->countryNormalizer = new CountryNormalizer(self::BASE);
    }

    public function testTranslateCode()
    {
        $samples = [
            'USA' => 'US',
            'MLT' => 'MT',
            'POL' => 'PL',
            'DEU' => 'DE',
            'ESP' => 'ES',
        ];

        foreach($samples as $key => $sample) {
            $this->assertEquals($sample, $this->countryNormalizer->translateCode($key));
        }

        foreach($samples as $key => $sample) {
            $this->assertEquals($key, $this->countryNormalizer->translateCode($sample, CountryNormalizer::ISO_ALPHA3));
        }
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionTranslatingCode() {
       $this->countryNormalizer->translateCode('UNK$');
    }
}
