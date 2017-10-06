<?php

namespace Tests\Recruitment\ApiBundle\Services;

use Recruitment\ApiBundle\Entity\OfferInterface;
use PHPUnit\Framework\TestCase;
use Recruitment\ApiBundle\Services\Normalizers\Country\CountryNormalizer;
use Recruitment\ApiBundle\Services\Offers\OfferStrategyBuilder;

class OfferAdvertiserTest extends TestCase
{
    const DATA_FOLDER = __DIR__ . '/../../../../src/Recruitment/ApiBundle/Util/ApiResponse/Files/Advertiser';
    private $lastRead = null;

    /**
     * @param int $advId
     * @param int $offerId
     * @return OfferInterface
     */
    private function getOfferForAdvertiser($advId, $offerId)
    {
        $countryNormalizer = new CountryNormalizer();
        $offerStrategy = new OfferStrategyBuilder($countryNormalizer);

        $offerRaw = file_get_contents(sprintf('%s/%s/offer_%d.json', self::DATA_FOLDER, $advId, $offerId));
        $this->lastRead = $offerData = json_decode($offerRaw, true);

        return $offerStrategy->buildOffer($offerData);
    }

    public function testAdvertiser1Offer1()
    {
        $offer = $this->getOfferForAdvertiser(1, 1);

        $this->assertEquals($offer->getName(), $this->lastRead['name']);
    }

    public function testAdvertiser2Offer1()
    {
        $offer = $this->getOfferForAdvertiser(2, 1);

        $this->assertEquals($offer->getPayout() * 1000, floatval($this->lastRead['campaigns']['points']));
    }
}
