<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:58
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\PatternsApplied;

use Recruitment\ApiBundle\Entity\OfferAdvertiserAdapterNotFound;

class OfferCollectionBuilder
{
    /**
     * @param array $data
     * @return OfferCollection
     * @throws \Exception
     */
    public static function build(array $data) : OfferCollection
    {
        $advertiserId = $data['advertiser_id'];
        $class = sprintf("Recruitment\\ApiBundle\\Util\\PatternsApplied\\OfferAdvertiser%dAdapter", $advertiserId);

        if (!class_exists($class)) {
            throw new OfferAdvertiserAdapterNotFound($advertiserId);
        }

        /** @var OfferAdvertiserAdapterInterface $advAdapter */
        $advAdapter = new $class;

        $offers = $advAdapter->extractOfferCollection($data);

        return $offers;
    }
}