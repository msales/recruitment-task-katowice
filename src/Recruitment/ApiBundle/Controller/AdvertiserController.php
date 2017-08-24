<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use Recruitment\ApiBundle\Controller\Abstraction\BaseRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdvertiserController extends BaseRestController
{
    /**
     * @REST\Get("/{advertiser}/{advertiserId}/offers",
     *     requirements={
     *       "advertiserId"="\d+"
     *  }
     * )
     *
     * @param string $advertiser
     * @param int    $advertiserId
     *
     * @return JsonResponse
     */
    public function getAdvertiserOffersAction(string $advertiser, int $advertiserId)
    {
        return $this->getApiResponse()->getBulkApiResponse($advertiser, $advertiserId);
    }

    /**
     * @REST\Get("/{advertiser}/{advertiserId}/{offer}/{offerId}",
     *     requirements={
     *       "advertiserId"="\d+",
     *       "offerId"="\d+",
     *  }
     * )
     *
     * @param string $advertiser
     * @param int    $advertiserId
     * @param string $offer
     * @param int    $offerId
     *
     * @return JsonResponse
     */
    public function getOfferAction(string $advertiser, int $advertiserId, string $offer, int $offerId)
    {
        return $this->getApiResponse()->getApiResponse($advertiser, $advertiserId, $offer, $offerId);
    }
}
