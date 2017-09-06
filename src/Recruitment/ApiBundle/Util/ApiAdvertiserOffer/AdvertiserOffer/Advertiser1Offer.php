<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/4/17
 * Time: 10:07 PM
 */

namespace Recruitment\ApiBundle\Util\ApiAdvertiserOffer\AdvertiserOffer;


use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Abstraction\AbstractAdvertiserOffer;

class Advertiser1Offer extends AbstractAdvertiserOffer
{

  /*
   * constructor for this class that extract the fields for data from advertiser 1
   */
  public function __construct(array $data)
  {
    // all the records seen so far have only one country even if they are array
    // we assume that we have only one country
    // multiple country are now addressed in the static method create
    $this->country = $data['country'];
    // all the payments have been done in USD,
    // we assume that they are USD
    $this->payout = $data['payout_amount'];
    $this->name = $data['name'];
    $this->platform = $data['mobile_platform'];
    /*
     * we make sure to set valid offer to true
     */
    $this->validOffer = true;

  }

  /**
   * this static function address the needs to create mutliple advertisers offers from a single advertiser entry
   * given that we could have multiple countries
   *
   * @param array data
   *
   * @return array
   */
  static public function create(array $data)
  {
    // initialize output array
    $output = array();

    // loop on all the countries
    foreach ( $data['countries'] as $country )
    {
      // prepare data for creator
      $element = $data;
      $element['country'] = $country;
      // create new advertiser offer and append to output array
      array_push($output,new Advertiser1Offer($element));
    }
    return $output;
  }
}