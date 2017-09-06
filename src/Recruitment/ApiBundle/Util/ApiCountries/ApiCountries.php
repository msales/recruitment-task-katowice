<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/4/17
 * Time: 11:07 PM
 */

namespace Recruitment\ApiBundle\Util\ApiCountries;


class ApiCountries
{
  // array with alpha 2 as keys and alpha 3 as values
  private $alpha2 = [];
  // array with alpha 3 as keys and alpha 2 as values
  private $alpha3 = [];

  function __construct()
  {
    /*
     * load json file with alpha 2 -> alpha 3
     */
    $this->alpha2 = json_decode(file_get_contents(__DIR__ . '/iso3.json'),true);

    /*
     * now takes the array just loaded and revers keys with values
     */
    $this->alpha3 = array_flip($this->alpha2);
  }

  /**
   * given the country code in format ISO 3166-1 alpha-2, it returns the country code in format ISO 3166-1 alpha-3
   *
   * @param string alpha2
   *
   * @return string alpha3
   */
  public function getAlpha3(string $alpha2)
  {
    return $this->alpha2[$alpha2];
  }

  /**
   * given the country code in format ISO 3166-1 alpha-3, it returns the country code in format ISO 3166-1 alpha-2
   *
   * @param string alpha3
   *
   * @return string alpha2
   */
  public function getAlpha2(string $alpha3)
  {
    return $this->alpha3[$alpha3];
  }

}
