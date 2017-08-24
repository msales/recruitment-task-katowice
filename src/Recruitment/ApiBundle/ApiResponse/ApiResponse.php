<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\ApiResponse;

use Recruitment\ApiBundle\ApiResponse\Loader\FileLoader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ApiResponse
{
    /**
     * @var FileLoader
     */
    private $fileLoader;

    /**
     * @param FileLoader $fileLoader
     */
    public function __construct(FileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    /**
     * @param string $entityName
     * @param int    $entityId
     *
     * @return JsonResponse
     */
    public function getBulkApiResponse(string $entityName, int $entityId)
    {
        return new JsonResponse($this->fileLoader->getBulkFilesContent($entityName, $entityId));
    }

    /**
     * @param string $entityName
     * @param int    $entityId
     * @param string $propertyName
     * @param int    $propertyId
     *
     * @return JsonResponse
     */
    public function getApiResponse(string $entityName, int $entityId, string $propertyName, int $propertyId)
    {
        $fileContent = $this->fileLoader->getFileContent($entityName, $entityId, $propertyName, $propertyId);

        if (!empty($fileContent)) {
            return new JsonResponse($fileContent);
        }

        throw new NotFoundResourceException('Resource not found.');
    }
}