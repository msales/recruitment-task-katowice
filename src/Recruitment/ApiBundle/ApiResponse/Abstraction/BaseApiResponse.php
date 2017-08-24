<?php
namespace Recruitment\ApiBundle\ApiResponse\Abstraction;

use Recruitment\ApiBundle\ApiResponse\Loader\FileLoader;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

abstract class BaseApiResponse
{
    /**
     * @var FileLoader
     */
    protected $fileLoader;

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
     * @return array
     */
    abstract function getBulkApiResponse(string $entityName, int $entityId);

    /**
     * @param string $entityName
     * @param int    $entityId
     * @param string $propertyName
     * @param int    $propertyId
     *
     * @return array
     */
    abstract function getApiResponse(string $entityName, int $entityId, string $propertyName, int $propertyId);
}