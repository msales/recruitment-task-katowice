<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\ApiResponse\Loader;

use Recruitment\ApiBundle\Util\ApiResponse\Finder\ApiFilesFinder;
use Recruitment\ApiBundle\Util\ApiResponse\Traits\ApiFilesVariablesTrait;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class FileLoader
{
    use ApiFilesVariablesTrait;

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
     * @param array $parameters
     *
     * @return array
     */
    public function getBulkFilesContent(array $parameters)
    {
        $finder = $this->apiFilesFinder->createDirectoryFinder(
            $parameters[$this->entityName],
            $parameters[$this->entityId]
        );
        $finder->name('*.json');

        return $this->retrieveFileContents($finder);
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function getFileContent(array $parameters)
    {
        $finder = $this->apiFilesFinder->createDirectoryFinder(
            $parameters[$this->entityName],
            $parameters[$this->entityId]
        );
        $finder->name(sprintf('%s_%s.json', $parameters[$this->propertyName], $parameters[$this->propertyId]));

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

        if (!empty($fileContents)) {
            return $fileContents;
        }

        throw new ResourceNotFoundException('Resource not found.');
    }
}