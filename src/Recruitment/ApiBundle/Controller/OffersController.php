<?php
/**
 * Created by PhpStorm.
 * User: bryanborg
 * Date: 10/09/2017
 * Time: 22:29
 */

namespace Recruitment\ApiBundle\Controller;


use Recruitment\ApiBundle\Entity\Offer;
use Recruitment\ApiBundle\Factory\AdvertiserOfferFactory;
use Recruitment\ApiBundle\Service\OffersApiService;
use Recruitment\ApiBundle\Util\Advertisers\BaseAdvertiserOffer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffersController extends Controller
{

  private $offersApiService;

  /**
   * Maps advertisers to a payout Stragey
   *
   * @var array
   */
  private $advertiserPayoutMapping = [
    1 => "flat_payout",
    2 => "points_payout"
  ];

  /**
   * @param OffersApiService $offersApiService
   */
  public function __construct(OffersApiService $offersApiService)
  {
    $this->offersApiService = $offersApiService;
  }


  /**
   *
   *
   * @param int $advertiserId
   */
  public function saveOffersByAdvertiserId(int $advertiserId)
  {
    $offersData = $this->offersApiService->getOffersByAdvertiserId(intval($advertiserId));

    $payoutProvider = $this->container->get("recruitment.provider.payout_provider");
    $payoutStrategy = $payoutProvider->get($this->advertiserPayoutMapping[$advertiserId]);


    foreach ($offersData as $offerData){
      $advertiserOffer = AdvertiserOfferFactory::build($advertiserId, $offerData);
      $payoutAmount = $payoutStrategy->getPayoutAmount($advertiserOffer->getPayout());
      $this->createOfferIfNotExists($advertiserOffer, $payoutAmount);
    }

  }

  /**
   * Saves the offer to the database, if it was not yet 'imported'
   *
   * @param BaseAdvertiserOffer $advertiserOffer
   * @return Offer
   */
  private function createOfferIfNotExists(BaseAdvertiserOffer $advertiserOffer, float $payoutAmount)
  {
    //check if the offer is already saved in the database
    if (!$this->offerExists($advertiserOffer->getCampaignId())) {
      $offer = new Offer();
      $offer->fromAdvertiserOffer($advertiserOffer);
      $offer->setPayout($payoutAmount);
      $this->container->get('doctrine')->getManager()->persist($offer);
      $this->container->get('doctrine')->getManager()->flush();
    }

  }

  /**
   * Returns true if offer with the given campaignId is already saved in the db
   *
   * @param int $campaignid
   * @return bool
   */
  private function offerExists(int $campaignId) : bool
  {
    return $this->container->get('doctrine')->getRepository(Offer::class)
      ->findOneByApplicationId($campaignId) instanceof Offer;


  }



}