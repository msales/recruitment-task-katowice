<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller\Abstraction;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Recruitment\ApiBundle\Util\ApiDataProvider\Abstraction\AbstractDataProvider;
use Recruitment\ApiBundle\Interfacing\AdvertiserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractBaseRestController extends FOSRestController implements ClassResourceInterface, AdvertiserInterface
{
    /**
     * @param array       $parameters
     * @param string|null $resource
     *
     * @return array
     */
    protected function getBulkData($parameters = [], string $resource = null)
    {
        return $this->getBulkProvider($resource)
            ->getBulkData($parameters)
            ;
    }
    protected function getData($parameters = [], string $resource = null)
    {
        return $this->getBulkProvider($resource)
            ->getData($parameters)
            ;
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function returnJsonResponse(array $data)
    {
        return new JsonResponse($data);
    }

    /**
     * @param string|null $resource
     *
     * @return AbstractDataProvider
     */
    public function getBulkProvider(string $resource = null)
    {
        if (null == $resource) {
            $resource = $this->getResource();
        }

        return $this->getDataProviderStrategy()->get($resource);
    }

    /**
     * @return
     */
    protected function getDataProviderStrategy()
    {
        return $this->get('recruitment.provider.data_provider');
    }

    abstract protected function getResource();


    /**
     * Take advertisers inputs and return a uniformed response
     *
     * @param integer $advertiserId
     * @param array $content
     * @return array
     */
    function standardize(int $advertiserId, array $content)
    {
        $allowedFields   = $this->getParameter('api')['allowed_fields'];
        $pointsRate   = $this->getParameter('api')['points_rate'];

        $parametersAsDotNotation = $this->multiDimensionalArrayToDotNotation($allowedFields);
        $contentAsDotNotation = $this->multiDimensionalArrayToDotNotation($content);

        $result = [];

        foreach ($contentAsDotNotation as $key => $value)
        {
            $keyInArray = explode('.', $key)[0];

            if (!isset($result[$keyInArray]))
            {
                $result[$keyInArray] = [];
            }

            foreach ($parametersAsDotNotation as $k => $v)
            {
                if (preg_match("/$k/",$key))
                {
                    if ($k === "campaigns.points" && $advertiserId === 2)
                    {
                        $value = $value * $pointsRate;
                    }

                    if ($v === "application_id")
                    {
                        $value = $advertiserId . "_" . $value;
                    }

                    $keyName = (empty($parametersAsDotNotation[$k])) ? $k : $v;

                    //Manage duplicates ex: for countries
                    if (isset($result[$keyInArray][$keyName]) && !is_array($result[$keyInArray][$keyName]))
                    {
                        $result[$keyInArray][$keyName] = [];

                        $result[$keyInArray][$keyName][] = (is_string($value)) ? trim($value) : $value;
                    }
                    else if (isset($result[$keyInArray][$keyName]) && is_array($result[$keyInArray][$keyName]))
                    {
                        if (!in_array($value, $result[$keyInArray][$keyName]))
                        {
                            $result[$keyInArray][$keyName][] = (is_string($value)) ? trim($value) : $value;
                        }
                    }
                    else if (!isset($result[$keyInArray][$keyName]))
                    {
                        $result[$keyInArray][$keyName] = (is_string($value)) ? trim($value) : $value;
                    }
                }
            }
        }

        return (array) $result;
    }

    /**
     * Convert multidimensional array to dot notation
     *
     * @param array $content
     * @return array
     */
    private function multiDimensionalArrayToDotNotation(array $content)
    {
        $arr = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($content));
        $result = array();
        foreach ($arr as $leafValue) {
            $keys = array();
            foreach (range(0, $arr->getDepth()) as $depth) {
                $keys[] = $arr->getSubIterator($depth)->key();
            }
            $result[ join('.', $keys) ] = $leafValue;
        }

        return (array) $result;
    }
}