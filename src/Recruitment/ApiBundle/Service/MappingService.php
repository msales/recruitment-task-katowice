<?php

namespace Recruitment\ApiBundle\Service;

use Recruitment\ApiBundle\Entity\Map;

class MappingService
{
    public function map(array $offer, Map $map) : array
    {
        $mappedFields = [];

        //example of a mapping of a field
        // 'platform' => ['details']['platform_id']
        foreach ($map->fields as $name => $path) {
            $mappedFields[$name] = $this->findValueFromPath($path, $offer);
        }
        return $mappedFields;
    }

    protected function findValueFromPath(string $path, array $offer)
    {
        preg_match_all("/\['(.*?)'\]/", $path, $paths);
        $field = [];

        foreach ($paths as $path) {
            if (!isset($offer[$path])) {
                $field = $offer[$path];
            }
        }

        return $field;
    }
}