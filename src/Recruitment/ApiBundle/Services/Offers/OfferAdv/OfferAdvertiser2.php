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
use Recruitment\ApiBundle\Services\Normalizers\Payout\PayoutTransformerPoints;

class OfferAdvertiser2 extends AbstractOfferAdvertiser
{
    /**
     * @param array $data
     * @return DummyOffer
     */
    public function extractOffer(array $data): DummyOffer
    {
        $offer = new DummyOffer();
        $campaign = $data['campaigns'];
        $country = array_pop($campaign['countries']);
        $offer->setCountry($this->countryNormalizer, $country);
        $applicationId = join(':', [$data['advertiser_id'], $campaign['cid'], $data['app_details']['bundle_id'], $offer->getCountry()]);
        $offer->setApplicationId($applicationId);
        $offer->setName($data['app_details']['developer']);  // seems to me a descriptive name
        $offer->setPlatform($data['app_details']['platform']);
        $offer->setPayout(new PayoutTransformerPoints(), floatval($campaign['points']));

        return $offer;
    }
}