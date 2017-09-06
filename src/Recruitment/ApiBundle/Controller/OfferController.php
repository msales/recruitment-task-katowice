<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Factory\AdvertiserOfferFactory;
use FOS\RestBundle\Controller\Annotations as REST;
use Symfony\Component\HttpFoundation\JsonResponse;
use Recruitment\ApiBundle\Entity\Offer;

class OfferController extends FOSRestController
{
  /**
   * @REST\Get("/offer/process/advertiser/{advertiserId}",
   *     requirements={
   *       "advertiserId"="\d+"
   *  }
   * )
   *
   * @param int                    $advertiserId
   *
   * @return JsonResponse
   */
  public function processAction(int $advertiserId)
  {

    /*
     * retrieve the entity manager
     */
    $em = $this->getDoctrine()->getManager();
    /*
     * build url to retrieve advertiser data
     */
    $advertiserUrl = preg_replace(
      "/\{advertiserId\}/",
      $advertiserId,
      $this->getParameter('offers')['advertiser_url']);

    /*
     * retrieve entries for the provided advertiser
     */
    $advertiserData = json_decode(
      file_get_contents($advertiserUrl),
      true);

    /*
     * initialize counters
     */
    $recordsProcessed = 0;
    $recordsSkipped = 0;
    $offersCreated = 0;

    /*
     * create advertiser offer factory
     */
    $advertiserOfferFactory = new AdvertiserOfferFactory();

    /*
     * loops on the data retrieved and insert data in db
     */
    foreach ($advertiserData as $element)
    {

      /*
       * get advertiser offer from advertiser offer factory
       */
      $advertiserOffers = $advertiserOfferFactory->getAdvertiserOffers($element);

      /*
       * check if it is a valid offer or not
       */
      if (!is_null($advertiserOffers))
      {
        /*
         * loop on all the advertiser offers
         */
        foreach ($advertiserOffers as $advertiserOffer) {
          /*
           * Advertiser offer has a method that return the offer ready to be used
           */
          $offer = $advertiserOffer->getOffer();

          // let's tell Doctrine that we eventually want to save the offer to the db
          $em->persist($offer);

          // update number of offers created
          $offersCreated += 1;
        }

        // update number of records proccessed
        $recordsProcessed += 1;
      }
      else
      {
        /*
        * this record does not have the fields that I need.
        * we skip it
        */
        $recordsSkipped += 1;
      }

    }

    // execute the queries on the db
    $em->flush();


    /*
     * if we got here, everything was a success
     */
    return new JsonResponse([
      'result' => 'success',
      'offersCreated' => $offersCreated,
      'recordsProcessed' => $recordsProcessed,
      'recordsSkipped' => $recordsSkipped
    ]);
  }

  /**
   * @REST\Get("/offer/{applicationId}")
   *     requirements={
   *       "applicationId"="\d+"
   *  }
   * )
   *
   * @param int                    $applicationId
   *
   * @return JsonResponse
   */
  public function getOfferAction(int $applicationId)
  {
    /*
     * find offer by application id
     */
    $offer = $this->getDoctrine()->getManager()->getRepository(Offer::class)->find($applicationId);

    /*
     * returns the json representation of the offer
     */
    return new JsonResponse($offer->toArray());
  }

  /**
   * @REST\Get("/offers/all")
   *
   * @return JsonResponse
   */
  public function getAllOffersAction()
  {
    /*
     * load all offers
     */
    $offers = $this->getDoctrine()->getManager()->getRepository(Offer::class)->findAll();

    /*
     * prepare array for json output
     */
    $output = [];
    foreach ($offers as $offer)
    {
      array_push($output,$offer->toArray());
    }
    /*
     * returns the json representation of the offer
     */
    return new JsonResponse($output);
  }

  /**
   * @REST\Get("/offers/delete/all")
   *
   * @return JsonResponse
   */
  public function deleteAllOffersAction()
  {
    /*
     * retrieve the entity manager
     */
    $em = $this->getDoctrine()->getManager();

    /*
     * load all offers
     */
    $offers = $em->getRepository(Offer::class)->findAll();

    /*
     * count how many offers we are removing
     */
    $offersRemoved = 0;

    /*
     * remove each offer individually
     */
    foreach ($offers as $offer) {
      // tells doctrine to remove this offer
      $em->remove($offer);
      // keeps track of how many we deleted
      $offersRemoved += 1;
    }
    // tells doctrine to delete the offers from the db
    $em->flush();

    // send back a reply'
    return new JsonResponse(array("result" => "success", "offersRemoved" => $offersRemoved));
  }

}

