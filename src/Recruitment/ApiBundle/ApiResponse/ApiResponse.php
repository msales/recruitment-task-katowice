<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\ApiResponse;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{
    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     *
     * @return JsonResponse
     */
    public function getApiResponseFromFiles(string $directoryName, int $directoryNumber)
    {
        return $this->getAllFilesContent($directoryName, $directoryNumber);
    }

    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     * @param string $elementName
     * @param int    $elementNumber
     *
     * @return JsonResponse
     */
    public function getApiResponseFromFile(string $directoryName, int $directoryNumber, string $elementName, int $elementNumber)
    {
        return $this->getFileContent($directoryName, $directoryNumber, $elementName, $elementNumber);
    }

    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     *
     * @return JsonResponse
     */
    private function getAllFilesContent(string $directoryName, int $directoryNumber)
    {
        $finder = $this->getFinder();
        $finder->in(sprintf('%s/Files/%s/%s', __DIR__, ucwords($directoryName), $directoryNumber))
            ->files()
            ->name('*.json')
        ;

        $fileContents = [];

        foreach ($finder as $file) {
            $fileContents[] = json_decode($file->getContents(), true);
        }

        return new JsonResponse($fileContents);
    }

    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     * @param string $elementName
     * @param int    $elementNumber
     *
     * @return JsonResponse
     */
    private function getFileContent(string $directoryName, int $directoryNumber, string $elementName, int $elementNumber)
    {
        $finder = $this->getFinder();
        $finder->in(sprintf('%s/Files/%s/%s', __DIR__, ucwords($directoryName), $directoryNumber))
            ->files()
            ->name(sprintf('%s_%s.json', $elementName, $elementNumber))
        ;

        $fileContents = "";

        foreach ($finder as $file) {
            $fileContents = json_decode($file->getContents(), true);
        }

        return new JsonResponse($fileContents);
    }

    /**
     * @return Finder
     */
    private function getFinder()
    {
        return new Finder();
    }
}