<?php
/**
 * Created by PhpStorm.
 * User: nitrosx
 * Date: 9/5/17
 * Time: 10:20 PM
 */

namespace Tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Recruitment\ApiBundle\Entity\Offer;


class OfferEntityRepositoryTest extends KernelTestCase
{

  /**
   * @var \Doctrine\ORM\EntityManager
   */
  private $em;

  /*
   * {@inheritDoc}
   */
  protected function setUp()
  {
    self::bootKernel();
    $this->em = static::$kernel->getContainer()
      ->get('doctrine')
      ->getManager();
  }

  public function testOffer()
  {
    // instantiate and populate offer
    $offer = new Offer();
    $offer->setPlatform('Android');
    $offer->setName('TestOffer-1');
    $offer->setPayout(1.23);
    $offer->setCountry('IT');

    // write to database
    $this->em->persist($offer);
    $this->em->flush();
    // remove offer
    unset($offer);

    // reload offer by name
    $offer = $this->em->getRepository(Offer::class)->findOneBy(array("name" => "TestOffer-1"));

    // assert that your calculator added the numbers correctly!
    $this->assertEquals('Android', $offer->getPlatform());
    $this->assertEquals('TestOffer-1', $offer->getName());
    $this->assertEquals(1.23, $offer->getPayout());
    $this->assertEquals('IT', $offer->getCountry());

  }


  /**
   * {@inheritDoc}
   */
  protected function tearDown()
  {
    parent::tearDown();
    $this->em->close();
    $this->em = null;
  }
}
