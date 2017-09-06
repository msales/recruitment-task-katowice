<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/4/17
 * Time: 10:07 PM
 */

namespace Recruitment\ApiBundle\Util\ApiAdvertiserOffer\AdvertiserOffer;


use Recruitment\ApiBundle\Util\ApiAdvertiserOffer\Abstraction\AbstractAdvertiserOffer;
use Recruitment\ApiBundle\Util\ApiCountries\ApiCountries;

class Advertiser2Offer extends AbstractAdvertiserOffer
{

  /*
   * constructor for this class that extract the fields for data from advertiser 1
   */
  public function __construct(array $data)
  {
    /*
     * all the records seen so far have only one country even if they are array
     * we assume that we have only one country
     *
     * also country code is in format ISO 3166-1 alpha-3, we need to convert it in ISO 3166-1 alpha-2
     *
     */
    $countryCode = new ApiCountries();
    $this->country = $countryCode->getAlpha2($data['country']);
    /*
     * advertiser #2 does not have an amount, but uses points
     * 10 points are worth it $0.01
     */
    $this->payout = 0.001 * $data['campaigns']['points'];
    /*
     * this advertiser does not have a name field in his records
     * so we build one from the data available
     */
    $this->name = $data['app_details']['bundle_id'] . ' - ' . $data['app_details']['developer'] . ' - ' . $data['campaigns']['cid'];
    $this->platform = $data['app_details']['platform'];

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
    foreach ( $data['campaigns']['countries'] as $country )
    {
      // prepare data for creator
      $element = $data;
      $element['country'] = $country;
      // create new advertiser offer and append to output array
      array_push($output,new Advertiser2Offer($element));
    }
    return $output;
  }

}