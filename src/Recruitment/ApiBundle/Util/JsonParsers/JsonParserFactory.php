<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\JsonParsers;

use Recruitment\ApiBundle\Exception\JsonParsers\UnknownFormatJsonParserException;

class JsonParserFactory
{
    /**
     * @param int $advertiserId
     * @return JsonParserInterface
     * @throws UnknownFormatJsonParserException
     */
    static public function make(int $advertiserId): JsonParserInterface
    {
        switch ($advertiserId) {
            case 1:
                $parser = new FirstFormatJsonParser();
                break;
            case 2:
                $parser = new SecondFormatJsonParser();
                break;
            default:
                throw new UnknownFormatJsonParserException(
                    "This format is unknown to the system, please check if needed Json Parser is available."
                );
        }

        return $parser;
    }
}