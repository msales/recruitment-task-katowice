<?php

namespace Recruitment\ApiBundle\Factory;

use Recruitment\ApiBundle\Interfaces\MapperInterface;
use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Interfaces\AdvertiserApplicationIdInterface;
use Recruitment\ApiBundle\Interfaces\CountryConverterInterface;
use Recruitment\ApiBundle\Interfaces\ConverterInterface;
use Recruitment\ApiBundle\Interfaces\RateInterface;

class OfferFactory
{

    protected $mapper;
    protected $advertiserApplicationIdInterface;
    protected $countryService;
    protected $rateService;
    protected $converter;

    public function __construct(
        AdvertiserApplicationIdInterface $advertiserApplicationId,
        MapperInterface $mapper,
        CountryConverterInterface $countryCodeService,
        RateInterface $rate,
        ConverterInterface $converter
    )
    {
        $this->advertiserApplicationIdInterface = $advertiserApplicationId;
        $this->mapper = $mapper;
        $this->countryService = $countryCodeService;
        $this->rateService = $rate;
        $this->converter = $converter;
    }
    public function create(array $offer) : string
    {
        $offer = $this->mapper->map($offer);

        $offer['application_id'] = $this->advertiserApplicationIdInterface->encode($offer['application_id']);
        $offer['country'] = $this->countryService->convertToIso2($offer['country']);
        $offer['currency'] = $this->rateService->getCurrency($offer['currency']);
        $offer['payout'] = $this->converter->convertPayout(
            $offer['payout'],
            $this->rateService->getRate($offer['advertiser_id'])
        );

        return new Offer($offer);
    }
}