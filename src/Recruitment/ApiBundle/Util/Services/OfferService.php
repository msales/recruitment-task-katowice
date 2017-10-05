<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\Services;

use Doctrine\ORM\EntityManager;
use Recruitment\ApiBundle\DTO\ParsedOfferData;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Exception\Services\OfferExistsException;

class OfferService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(ParsedOfferData $parsedOfferData): Offer
    {
        $offerRepository = $this->entityManager->getRepository(Offer::class);

        if ($offerRepository->findBy(['applicationId' => $parsedOfferData->applicationId])) {
            throw new OfferExistsException("Offer already exists in Database");
        }

        $offer = new Offer();
        $offer->setName($parsedOfferData->name);
        $offer->setApplicationId($parsedOfferData->applicationId);
        $offer->setPlatform($parsedOfferData->platform);
        $offer->setPayout($parsedOfferData->pointsPayout() ? floatval($parsedOfferData->payout / 1000) : $parsedOfferData->payout);
        $offer->setCountry($parsedOfferData->country);

        $this->entityManager->persist($offer);
        $this->entityManager->flush();

        return $offer;
    }

    public function all()
    {
        return $this->entityManager->getRepository(Offer::class)->findAll();
    }

    public function find(int $id)
    {
        return $this->entityManager->getRepository(Offer::class)->find($id);
    }

    public function delete(int $id)
    {
        $offer = $this->entityManager->getRepository(Offer::class)->find($id);
        $this->entityManager->remove($offer);
        $this->entityManager->flush();
    }
}