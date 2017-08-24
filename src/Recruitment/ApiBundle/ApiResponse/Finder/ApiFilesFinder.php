<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\ApiResponse\Finder;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiFilesFinder
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param string $directoryName
     * @param int    $directoryNumber
     *
     * @return Finder
     */
    public function createDirectoryFinder(string $directoryName, int $directoryNumber)
    {
        $this->finder->in(sprintf('/%s/../Files/%s/%s', __DIR__, ucwords($directoryName), $directoryNumber))
            ->files()
        ;

        return $this->finder;
    }
}