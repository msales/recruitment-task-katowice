<?php
declare(strict_types=1);
namespace Recruitment\ApiBundle\Util\ApiDataProvider\Abstraction;

use Msales\GrapesBundle\Provider\ServiceProvider;

abstract class AbstractDataProvider extends ServiceProvider
{
    abstract function getBulkData($parameters = []);

    abstract function getData($parameters = []);

}