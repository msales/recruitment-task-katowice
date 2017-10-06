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

class OffersAwsFetcherService implements OffersFetcherInterface
{
    /** @var string */
    protected $url;
    /** @var string */
    protected $user;
    /** @var string */
    protected $password;

    /**
     * @param string $url
     * @param string $user
     * @param string $password
     */
    public function __construct($url, $user, $password)
    {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
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