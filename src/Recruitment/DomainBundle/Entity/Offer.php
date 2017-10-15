<?php

namespace Recruitment\DomainBundle\Entity;

use Recruitment\DomainBundle\Advertiser\Value\Platform;

class Offer
{
    public $applicationId;
    public $advertiserId;
    public $country;
    public $payout;
    public $name;
    public $platform;

    public function getApplicationId(): int
    {
        return $this->applicationId;
    }

    public function setApplicationId(int $applicationId)
    {
        $this->applicationId = $applicationId;
    }

    public function getAdvertiserId(): int
    {
        return $this->advertiserId;
    }

    public function setAdvertiserId(int $advertiserId)
    {
        $this->advertiserId = $advertiserId;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function getPayout(): float
    {
        return $this->payout;
    }

    public function setPayout(float $payout)
    {
        $this->payout = $payout;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getPlatform(): Platform
    {
        return $this->platform;
    }

    public function setPlatform(Platform $platform)
    {
        $this->platform = $platform;
    }
}