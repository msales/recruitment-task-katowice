<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use Recruitment\ApiBundle\Controller\Abstraction\AbstractBaseRestController;
use Recruitment\ApiBundle\Util\ApiResponse\Traits\ApiFilesVariablesTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdvertiserController extends AbstractBaseRestController
{
    use ApiFilesVariablesTrait;

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
    public function cgetAction(string $advertiser, int $advertiserId)
    {
        return $this->returnJsonResponse(
            $this->getBulkData(
                [
                    $this->entityName => $advertiser,
                    $this->entityId   => $advertiserId,
                ]
            )
        );
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
    public function getAction(string $advertiser, int $advertiserId, string $offer, int $offerId)
    {
        return $this->returnJsonResponse(
            $this->getData(
                [
                    $this->entityName   => $advertiser,
                    $this->entityId     => $advertiserId,
                    $this->propertyName => $offer,
                    $this->propertyId   => $offerId,
                ]
            )
        );
    }

    protected function getResource()
    {
        return 'advertiser_data';
    }
}
