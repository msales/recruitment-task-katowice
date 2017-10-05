<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\JsonParsers;

use Recruitment\ApiBundle\DTO\ParsedOfferData;

interface JsonParserInterface
{
    /**
     * @param string $jsonData
     * @return array|ParsedOfferData[]
     */
    public function parse(string $jsonData): array;
}