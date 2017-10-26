<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 16:28
 */

namespace Recruitment\ApiBundle\Services\Offers;


use Recruitment\ApiBundle\Exceptions\RemoteDataException;
use Symfony\Component\Intl\Exception\NotImplementedException;

class OffersGuzzleFetcherService implements OffersFetcherInterface
{
    protected $endpoint;

    /**
     * OffersFetcherService constructor.
     * @param string $endpoint
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param int $id
     * @return array
     * @throws RemoteDataException
     */
    public function getOffersOfAdvertiser($id)
    {
        throw new NotImplementedException('getOffersOfAdvertiser for Guzzle is not implemented yet!');
    }
}