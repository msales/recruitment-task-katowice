<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\DTO;

class ParsedOfferData
{
    /**
     * @var string
     */
    public $applicationId;

    /**
     * @var string
     */
    public $country;

    /**
     * @var float
     */
    public $payout;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $platform;
}