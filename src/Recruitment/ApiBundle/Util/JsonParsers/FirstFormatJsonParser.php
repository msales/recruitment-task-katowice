<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\JsonParsers;

use Recruitment\ApiBundle\DTO\ParsedOfferData;

class FirstFormatJsonParser implements JsonParserInterface
{
    /**
     * @param string $jsonData
     * @return array
     */
    public function parse(string $jsonData): array
    {
        $parsedData = [];
        $decoded = json_decode($jsonData, true);

        foreach ($decoded as $data) {
            $tempObject = new ParsedOfferData();
            $tempObject->applicationId = $data['mobile_app_id'];
            $tempObject->country = $data['countries'][0];
            $tempObject->name = $data['name'];
            $tempObject->platform = $data['mobile_platform'];
            $tempObject->payout = $data['payout_amount'];
            $parsedData[] = $tempObject;
        }

        return $parsedData;
    }
}