<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Controller\Abstraction;

use FOS\RestBundle\Controller\FOSRestController;
use Recruitment\ApiBundle\ApiResponse\ApiResponse;

abstract class BaseRestController extends FOSRestController
{
    /**
     * @return ApiResponse
     */
    protected function getApiResponse()
    {
        return $this->get('recruitment.api_response');
    }
}