<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use Recruitment\ApiBundle\Controller\Abstraction\AbstractBaseRestController;
use Recruitment\ApiBundle\Util\ApiResponse\Traits\ApiFilesVariablesTrait;
use Recruitment\ApiBundle\Entity\Offer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Money\Currency;
use Money\Money;

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
        $data = $this->getBulkData(
            [
                $this->entityName => $advertiser,
                $this->entityId   => $advertiserId,
            ]
        );

        //Api response differs from advertisers, standardize is a wrapper
        $standardizedData = $this->standardize($advertiserId, $data);

        $defaultCurrency = $this->getParameter('tbbc_money.reference_currency');

        //Get the entity manager
        $em = $this->getDoctrine()->getManager();

        foreach ($standardizedData as $k => $v) {
            //Prepare Money object

            //Even if default currency is USD, we asume that currency is flexible
            $currency = (!isset($standardizedData[$k]['payout_currency'])) ? $defaultCurrency : $standardizedData[$k]['payout_currency'];
            $amount = (integer) $standardizedData[$k]['payout_amount'] * 100;
            $payout = new Money($amount, new Currency($currency));

            //Get all countries
            $countries = (array) $standardizedData[$k]['countries'];

            //App name
            $name = (!isset($data[$k]['name'])) ? '' : $standardizedData[$k]['name'];

            $offer = new Offer();
            $offer->setApplicationId($standardizedData[$k]['application_id']);
            $offer->setPayout($payout);
            $offer->setName($name);
            $offer->setCountry($countries);
            $offer->setPlatform(trim($standardizedData[$k]['platform']));
            $em->persist($offer);

        }
        $em->flush();

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
