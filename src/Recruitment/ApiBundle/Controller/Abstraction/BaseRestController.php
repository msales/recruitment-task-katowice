<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller\Abstraction;

use FOS\RestBundle\Controller\FOSRestController;
use Recruitment\ApiBundle\ApiResponse\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseRestController extends FOSRestController
{
    /**
     * @return ApiResponse
     */
    protected function getApiResponse()
    {
        return $this->get('recruitment.api_response');
    }

    /**
     * @param JsonResponse $response
     *
     * @return bool
     */
    protected function isEmptyResponse(JsonResponse $response)
    {
        $responseContent = json_decode($response->getContent());
        if ((sizeof($responseContent) == 0) || empty($responseContent) || is_null($responseContent)) {
            $requestUri = explode("/app_dev.php", $_SERVER['REQUEST_URI']);
            throw new NotFoundHttpException(
                sprintf('No route or resource found for "GET %s"', $requestUri[1])
            );
        }

        return false;
    }
}