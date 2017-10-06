<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 16:28
 */

namespace Recruitment\ApiBundle\Services\Offers;


use Recruitment\ApiBundle\Exceptions\RemoteDataException;

class OffersCurlFetcherService implements OffersFetcherInterface
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
        $url = str_replace('{advertiserId}', $id, $this->endpoint);
        $handler = curl_init();
        curl_setopt_array($handler, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Remote Access System',
            CURLOPT_HEADER => 1,
        ]);
        $response = curl_exec($handler);

        $header_size = curl_getinfo($handler, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        curl_close($handler);

        if(strpos($header, 'HTTP/1.1 200') !== 0){
            throw new RemoteDataException($header);
        }

        return json_decode($body, true);
    }
}