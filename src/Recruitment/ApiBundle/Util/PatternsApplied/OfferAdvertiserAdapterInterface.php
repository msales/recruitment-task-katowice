<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:47
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\PatternsApplied;

interface OfferAdvertiserAdapterInterface
{
    /**
     * @param array $data
     * @return OfferCollection
     */
    public function extractOfferCollection(array $data) : OfferCollection;
}