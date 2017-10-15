<?php

namespace Recruitment\DomainBundle\Advertiser;

use Doctrine\ORM\EntityManager;
use Recruitment\DomainBundle\Entity\Offer;

class OfferService
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Offer[] $offers
     */
    public function persistOffers(array $offers)
    {
        $this->entityManager->getConnection()->beginTransaction();
        foreach ($offers as $offer) {
            $this->entityManager->persist($offer);
        }
        $this->entityManager->flush();
        $this->entityManager->getConnection()->commit();
    }
}