<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:49
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\PatternsApplied;

use Recruitment\ApiBundle\Entity\Offer;

class OfferAdvertiser2Adapter implements OfferAdvertiserAdapterInterface
{
    /**
     * @param array $data
     * @return OfferCollection
     */
    public function extractOfferCollection(array $data): OfferCollection
    {
        $collection = new OfferCollection();
        $campaign = $data['campaigns'];
        foreach ($campaign['countries'] as $country) {
            $applicationId = join(':', [$data['advertiser_id'], $campaign['cid'], $data['app_details']['bundle_id'], $country]);
            $offer = new Offer();
            $offer->setCountry($country);
            $offer->setApplicationId($applicationId);
            $offer->setName($data['app_details']['developer']);  // seems to me a descriptive name
            $offer->setPlatform($data['app_details']['platform']);
            $offer->setPayout($campaign['points']/1000);

            $collection->addOffer($offer);
        }

        return $collection;
    }
}