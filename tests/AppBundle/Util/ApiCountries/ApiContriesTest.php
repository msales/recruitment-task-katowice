<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/5/17
 * Time: 11:55 PM
 */

namespace Tests\AppBundle\Util\ApiCountries;

use PHPUnit_Framework_TestCase;
use Recruitment\ApiBundle\Util\ApiCountries\ApiCountries;

class ApiContriesTest extends PHPUnit_Framework_TestCase
{
  public function testApiCountries()
  {
    /*
     * this test just make sure that we can instantiate the class
     */
    $countries = new ApiCountries();

    $this->assertTrue($countries instanceof ApiCountries);
  }

  public function testAlpha2And3()
  {
    /*
     * this test check if the class properly conert from alpha 3 to 2 and viceversa
     */
    $countries = new ApiCountries();

    // check if convert from alpha 3 to alpha 2
    $this->assertEquals('US',$countries->getAlpha2('USA'));
    $this->assertEquals('BR',$countries->getAlpha2('BRA'));
    $this->assertEquals('IT',$countries->getAlpha2('ITA'));

    // check if convert from alpha 2 to alpha 3
    $this->assertEquals('USA',$countries->getAlpha3('US'));
    $this->assertEquals('BRA',$countries->getAlpha3('BR'));
    $this->assertEquals('ITA',$countries->getAlpha3('IT'));

  }


}