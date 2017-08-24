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
     * @param string $directoryName
     * @param int    $directoryNumber
     *
     * @return array
     */
    public function getBulkFilesContent(string $directoryName, int $directoryNumber)
    {
        $finder = $this->apiFilesFinder->setDirectoryFinder($directoryName, $directoryNumber);
        $finder->name('*.json');

        return $this->retrieveFileContents($finder);
    }

    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     * @param string $elementName
     * @param int    $elementNumber
     *
     * @return array
     */
    public function getFileContent(string $directoryName, int $directoryNumber, string $elementName, int $elementNumber)
    {
        $finder = $this->apiFilesFinder->setDirectoryFinder($directoryName, $directoryNumber);
        $finder->name(sprintf('%s_%s.json', $elementName, $elementNumber));

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