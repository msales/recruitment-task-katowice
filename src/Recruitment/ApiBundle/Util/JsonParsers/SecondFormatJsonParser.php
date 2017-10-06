<?php
declare(strict_types=1);

namespace Recruitment\ApiBundle\Util\JsonParsers;

use League\ISO3166\ISO3166;
use Recruitment\ApiBundle\DTO\ParsedOfferData;

class SecondFormatJsonParser implements JsonParserInterface
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
            $tempObject->applicationId = $data['app_details']['bundle_id'];
            $tempObject->country = (new ISO3166)->alpha3($data['campaigns']['countries'][0])['alpha2'];
            $tempObject->name = $data['app_details']['developer'] . ' ' . $data['app_details']['version'];
            $tempObject->platform = $data['app_details']['platform'];
            $tempObject->payout = floatval($data['campaigns']['points'] / 1000);
            $parsedData[] = $tempObject;
        }

        return $parsedData;
    }
}