<?php

namespace tests\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Recruitment\ApiBundle\Command\FetchOffersCommand;

class FetchOffersCommandTest extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
    }

    /**
     * @test
     */
    public function it_throws_an_exception_for_invalid_id()
    {
        $this->expectException(\InvalidArgumentException::class);
        $application = new Application(static::$kernel);
        $application->add(new FetchOffersCommand());
        $command = $application->find('app:fetch-offers');
        $command->setApplication($application);
        $tester = new CommandTester($command);
        $tester->execute(['advertiser_id' =>'sfsdfs']);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_for_no_data()
    {
        $this->expectException(\Exception::class);
        $application = new Application(static::$kernel);
        $application->add(new FetchOffersCommand());
        $command = $application->find('app:fetch-offers');
        $command->setApplication($application);
        $tester = new CommandTester($command);
        $tester->execute(['advertiser_id' =>'52']);
    }


}