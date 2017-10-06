<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 20:01
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Exceptions;

use Throwable;

class OfferAdvertiserNotFound extends \Exception
{
    public function __construct($advId, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Class to support Offers for advertiser {$advId} not found, you should create it in Recruitment\ApiBundle\PatternsApplied\OfferAdvertiser{$advId}Adapter.php !", $code, $previous);
    }
}