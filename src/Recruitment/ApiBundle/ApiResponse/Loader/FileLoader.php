<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\ApiResponse\Loader;

use Recruitment\ApiBundle\ApiResponse\Finder\ApiFilesFinder;
use Symfony\Component\Finder\Finder;

class FileLoader
{
    /**
     * @var ApiFilesFinder
     */
    private $apiFilesFinder;

    /**
     * @param ApiFilesFinder $apiFilesFinder
     */
    public function __construct(ApiFilesFinder $apiFilesFinder)
    {
        $this->apiFilesFinder = $apiFilesFinder;
    }

    /**
     * @param string $entityName
     * @param int    $entityId
     *
     * @return array
     */
    public function getBulkFilesContent(string $entityName, int $entityId)
    {
        $finder = $this->apiFilesFinder->createDirectoryFinder($entityName, $entityId);
        $finder->name('*.json');

        return $this->retrieveFileContents($finder);
    }

    /**
     * @param string $entityName
     * @param int    $entityId
     * @param string $propertyName
     * @param int    $propertyId
     *
     * @return array
     */
    public function getFileContent(string $entityName, int $entityId, string $propertyName, int $propertyId)
    {
        $finder = $this->apiFilesFinder->createDirectoryFinder($entityName, $entityId);
        $finder->name(sprintf('%s_%s.json', $propertyName, $propertyId));

        return $this->retrieveFileContents($finder);
    }

    /**
     * @param Finder $finder
     *
     * @return array
     */
    private function retrieveFileContents(Finder $finder)
    {
        $fileContents = [];
        foreach ($finder as $file) {
            $fileContents[] = json_decode($file->getContents(), true);
        }

        return $fileContents;
    }
}