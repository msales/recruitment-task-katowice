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

    /**
     * OfferService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param ParsedOfferData $parsedOfferData
     * @return Offer
     * @throws OfferExistsException
     */
    public function create(ParsedOfferData $parsedOfferData): Offer
    {
        $offerRepository = $this->entityManager->getRepository(Offer::class);

        if ($offerRepository->findBy(['applicationId' => $parsedOfferData->applicationId])) {
            throw new OfferExistsException("Offer already exists in database");
        }

        $offer = new Offer();
        $offer->setName($parsedOfferData->name);
        $offer->setApplicationId($parsedOfferData->applicationId);
        $offer->setPlatform($parsedOfferData->platform);
        $offer->setPayout($parsedOfferData->payout);
        $offer->setCountry($parsedOfferData->country);

        $this->entityManager->persist($offer);
        $this->entityManager->flush();

        return $offer;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->entityManager->getRepository(Offer::class)->findAll();
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function find(int $id)
    {
        return $this->entityManager->getRepository(Offer::class)->find($id);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $offer = $this->entityManager->getRepository(Offer::class)->find($id);
        $this->entityManager->remove($offer);
        $this->entityManager->flush();
    }
}