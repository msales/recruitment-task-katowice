<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:49
 */
declare(strict_types=1);

namespace Recruitment\ApiBundle\Services\Offers\OfferAdv;

use Recruitment\ApiBundle\Dummies\DummyOffer;
use Recruitment\ApiBundle\Services\Normalizers\Payout\PayoutTransformerDirect;

class OfferAdvertiser1 extends AbstractOfferAdvertiser
{
    /**
     * @param array $data
     * @return DummyOffer
     */
    public function extractOffer(array $data): DummyOffer
    {
        $offer = new DummyOffer();
        $country = array_pop($data['countries']);
        $offer->setCountry($this->countryNormalizer, $country);
        $applicationId = join(':', [$data['advertiser_id'], $data['campaign_id'], $data['mobile_app_id'], $offer->getCountry()]);
        $offer->setApplicationId($applicationId);
        $offer->setName($data['name']);
        $offer->setPlatform($data['mobile_platform']);
        $offer->setPayout(new PayoutTransformerDirect(), floatval($data['payout_amount']));

        return $offer;
    }
}