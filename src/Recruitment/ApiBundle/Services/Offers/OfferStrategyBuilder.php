<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:35
 */

namespace Recruitment\ApiBundle\Services\Offers;

use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Exceptions\OfferAdvertiserNotFound;
use Recruitment\ApiBundle\Services\Normalizers\Country\CountryNormalizer;
use Recruitment\ApiBundle\Services\Offers\OfferAdv\OfferAdvertiser1;
use Recruitment\ApiBundle\Services\Offers\OfferAdv\OfferAdvertiser2;

class OfferStrategyBuilder
{
    /** @var CountryNormalizer */
    protected $countryNormalizer;

    /**
     * @param CountryNormalizer $countryNormalizer
     */
    public function __construct(CountryNormalizer $countryNormalizer)
    {
        $this->countryNormalizer = $countryNormalizer;
    }

    /**
     * @param array $data
     * @return Offer
     * @throws OfferAdvertiserNotFound
     */
    public function buildOffer(array $data)
    {
        $advertiserId = $data['advertiser_id'];

        // this switch is pretty visual when the amount of advertisers is low,
        // in order to improve the algorithm is better to use a generated parametric class name
        // $className = sprintf("Recruitment\ApiBundle\Services\Offers\OfferAdv\OfferAdvertiser%d", $advertiserId)
        switch ($advertiserId) {

            case 1:
                $builder = new OfferAdvertiser1($this->countryNormalizer);
                break;

            case 2:
                $builder = new OfferAdvertiser2($this->countryNormalizer);
                break;

            default:
                throw new OfferAdvertiserNotFound($advertiserId);

        }
        $dummyOffer = $builder->extractOffer($data);

        return OfferMapper::buildFromDummy($dummyOffer);
    }
}