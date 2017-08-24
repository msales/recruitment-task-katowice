<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller\Abstraction;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Recruitment\ApiBundle\ApiResponse\ApiFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseRestController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @param string $entityName
     * @param int    $entityId
     *
     * @return array
     */
    protected function getBulkData(string $entityName, int $entityId)
    {
        return $this->getApiResponse()->getBulkApiResponse($entityName, $entityId);
    }

    /**
     * @param string $entityName
     * @param int    $entityId
     * @param string $propertyName
     * @param int    $propertyId
     *
     * @return array
     */
    protected function getData(string $entityName, int $entityId, string $propertyName, int $propertyId)
    {
        return $this->getApiResponse()->getApiResponse($entityName, $entityId, $propertyName, $propertyId);
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
     * @return ApiFileResponse
     */
    protected function getApiResponse()
    {
        return $this->get('recruitment.api_response');
    }
}