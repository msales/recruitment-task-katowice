<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:46
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\PatternsApplied;


use Recruitment\ApiBundle\Entity\OfferInterface;

class OfferCollection
{
    /** @var OfferInterface[] */
    private $collection;

    public function addOffer(OfferInterface $offer)
    {
        $this->collection[] = $offer;
    }

    /**
     * @return OfferInterface[]
     */
    public function getOffers()
    {
        return $this->collection;
    }
}