<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\ApiDataProvider\Provider;

use Recruitment\ApiBundle\Util\ApiDataProvider\Abstraction\AbstractDataProvider;
use Recruitment\ApiBundle\Util\ApiResponse\Loader\FileLoader;

class AdvertiserDataProvider extends AbstractDataProvider
{
    /**
     * @var FileLoader
     */
    protected $fileLoader;

    public function __construct(FileLoader $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    function getBulkData($parameters = [])
    {
        return $this->fileLoader->getBulkFilesContent($parameters);
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    function getData($parameters = [])
    {
        return $this->fileLoader->getFileContent($parameters);
    }
}