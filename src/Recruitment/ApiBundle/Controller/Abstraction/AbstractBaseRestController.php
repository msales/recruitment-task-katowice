<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller\Abstraction;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Recruitment\ApiBundle\Util\ApiDataProvider\Abstraction\AbstractDataProvider;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class AbstractBaseRestController extends FOSRestController implements ClassResourceInterface
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
}