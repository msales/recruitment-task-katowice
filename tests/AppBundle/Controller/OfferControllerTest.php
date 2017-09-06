<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/5/17
 * Time: 11:36 PM
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OfferControllerTest extends WebTestCase
{
  public function testDelete()
  {
    /*
     * execute a delete all on the offers and make sure that we get a success
     */

    $client = static::createClient();

    // execute offers delete all
    $client->request('GET', '/offers/delete/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);
  }

  public function testEmpty()
  {
    /*
     * execute a delete all on the offers and count the retrieved data
     */

    $client = static::createClient();

    // execute offers delete all
    $client->request('GET', '/offers/delete/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);

    // retrieve all offers
    $client->request( 'GET', '/offers/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // we should got 0 records returned
    $this->assertEquals(0, count($responseData));

  }

  public function testProcessAdvertiser()
  {
    /*
     * delete all the offers, process one advertisers and check that the right number of offers were created
     */

    $client = static::createClient();

    // execute offers delete all
    $client->request('GET', '/offers/delete/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);

    // execute offers delete all
    $client->request('GET', '/offer/process/advertiser/1');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);
    // extract how many offers were created
    $offersCreated = $responseData['offersCreated'];

    // retrieve all offers
    $client->request( 'GET', '/offers/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if the right number of offers were created
    $this->assertEquals($offersCreated,count($responseData));

  }

  public function testSingleOffer()
  {
    /*
     * delete all the offers, process one advertisers and retrieve one specific offer
     */

    $client = static::createClient();

    // execute offers delete all
    $client->request('GET', '/offers/delete/all');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);

    // execute offers delete all
    $client->request('GET', '/offer/process/advertiser/1');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if we got a success
    $this->assertEquals('success', $responseData['result']);
    // extract how many offers were created
    $offersCreated = $responseData['offersCreated'];

    // retrieve offer with application_id = 1
    $client->request( 'GET', '/offer/1');
    // extract response
    $response = $client->getResponse();
    // check if we got 200
    $this->assertSame(200, $response->getStatusCode());
    // extract json content and convert to array
    $responseData = json_decode($response->getContent(), true);
    // check if the right number of offers were created
    $this->assertEquals(1,count($responseData));

  }

}