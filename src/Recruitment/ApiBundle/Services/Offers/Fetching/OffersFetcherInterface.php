<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 16:34
 */

namespace Recruitment\ApiBundle\Services\Offers;

use Recruitment\ApiBundle\Entity\RemoteDataException;

interface OffersFetcherInterface
{
    /**
     * @param int $id
     * @return array
     * @throws RemoteDataException
     */
    public function getOffersOfAdvertiser($id);
}