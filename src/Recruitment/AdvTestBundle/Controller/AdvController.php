<?php
/**
 * Created by PhpStorm.
 * User: msalestrial
 * Date: 04/09/2017
 * Time: 11:47
 */

namespace Recruitment\AdvTestBundle\Controller;

use Recruitment\AdvTestBundle\Entity\Adv;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvController extends Controller
{
    /**
     * @var \Recruitment\AdvTestBundle\Controller\ApiCallController $api_service
     */
    private $api_service;
    
    private $advertiser_indentifier;
    
    public function __construct(ApiCallController $api_call_controller, string $adv_ident) {
        $this->api_service = $api_call_controller;
        $this->advertiser_indentifier = $adv_ident;
    }

    /**
     * action to fetch information from the Advertiser api
     *
     * @param int $advId
     *
     * @return string
     */
    public function addAllOffersFromAdviserAction(int $advId = 0) : string
    {
        $url = sprintf($this->getParameter('full_api_url'), $advId);
        $json_response = $this->api_service->curlAction($url);
    
        $offers_stored = "Saved new offer with id ";
        foreach ($json_response as $offer) {
            $offers_stored .= " " . $this->mapAdvertiserData($offer[$this->advertiser_indentifier], $offer);
        }

        return $offers_stored;
    }

    /**
     * action to fetch information from the Advertiser api
     *
     * @param int $advId
     * @param int $offerId
     *
     * @return string
     */
    public function addSingleOfferFromAdviserAction(int $advId = 0, int $offerId = 0) : string
    {
        
        $url = sprintf($this->getParameter('single_offer_url'), $advId, $offerId);
        $json_response = $this->api_service->curlAction($url);

        $new_adv_application_id = $this->mapAdvertiserData($json_response[$this->advertiser_indentifier], $json_response);

        return 'Saved new offer with id ' . $new_adv_application_id;
    }

    private function mapAdvertiserData(int $adv_type, array $attributes) : int
    {
        $em = $this->getDoctrine()->getManager();
    
        /**
         * @var \Recruitment\AdvTestBundle\Entity\Adv $new_adv
         */
        $new_adv = new Adv();
        
        //Msales Grapes Strategy to retrieve at runtime the correct type of the adv obj
        $advHandlerStrategy = $this->container->get("adv.strategy");
        $advertiser = $advHandlerStrategy->get($adv_type);
        $advertiser->init($attributes);
        
        $new_adv->setPlatform($advertiser->getPlatform());
        $new_adv->setPayout($advertiser->getPayout());
        $new_adv->setCountry($advertiser->getCountry());
        $new_adv->setName($advertiser->getName());

        $em->persist($new_adv);
        $em->flush();

        return $new_adv->getApplicationId();
    }
    
}