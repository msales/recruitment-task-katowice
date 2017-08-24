<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\ApiResponse;

use Recruitment\ApiBundle\ApiResponse\Abstraction\BaseApiResponse;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ApiFileResponse extends BaseApiResponse
{
    /**
     * {@inheritdoc}
     */
    public function getBulkApiResponse(string $entityName, int $entityId)
    {
        return $this->fileLoader->getBulkFilesContent($entityName, $entityId);
    }

    /**
     * {@inheritdoc}
     */
    public function getApiResponse(string $entityName, int $entityId, string $propertyName, int $propertyId)
    {
        $fileContent = $this->fileLoader->getFileContent($entityName, $entityId, $propertyName, $propertyId);

        if (!empty($fileContent)) {
            return $fileContent;
        }

        throw new NotFoundResourceException('Resource not found.');
    }
}