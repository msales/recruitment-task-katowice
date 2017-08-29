<?php
namespace Recruitment\ApiBundle\Fakes;


use Recruitment\ApiBundle\Entity\Advertiser;

class AdvertiserFake implements Advertiser
{
    public function getId()
    {
        return 1;
    }

}