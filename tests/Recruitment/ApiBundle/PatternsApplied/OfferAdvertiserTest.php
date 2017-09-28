<?php

namespace Tests\Recruitment\ApiBundle\PatternsApplied;

use Recruitment\ApiBundle\Entity\OfferInterface;
use Recruitment\ApiBundle\Util\PatternsApplied\OfferCollectionBuilder;
use PHPUnit\Framework\TestCase;

class OfferAdvertiserTest extends TestCase
{
    const DATA_FOLDER = '/../../../../src/Recruitment/ApiBundle/Util/ApiResponse/Files/Advertiser';
    private $lastRead = null;

    /**
     * @param int $advId
     * @param int $offerId
     * @return OfferInterface
     */
    private function getOfferForAdvertiser($advId, $offerId)
    {
        $offerRaw = file_get_contents(sprintf('%s/%s/offer_%d.json', self::DATA_FOLDER, $advId, $offerId));
        $this->lastRead = $offerData = json_decode($offerRaw, true);

        $offers = OfferCollectionBuilder::build($offerData);

        return array_pop($offers->getOffers());
    }

    public function testAdvertiser1Offer1()
    {
        $offer = $this->getOfferForAdvertiser(1, 1);

        $this->assertEquals($offer->getName(), $this->lastRead['name']);
    }

    public function testAdvertiser2Offer1()
    {
        $offer = $this->getOfferForAdvertiser(1, 1);

        $this->assertEquals($offer->getPayout(), $this->lastRead['campaigns']['points'] * 1000);
    }
}
