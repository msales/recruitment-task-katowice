<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:24
 */

namespace Recruitment\ApiBundle\Dummies;

use Recruitment\ApiBundle\Services\Normalizers\Country\CountryNormalizer;
use Recruitment\ApiBundle\Services\Normalizers\Payout\PayoutTransformerInterface;

class DummyOffer
{
    private $applicationId;
    private $country;
    private $payout;
    private $name;
    private $platform;

    const ANDROID_PLATFORM = 'Android';
    const IOS_PLATFORM = 'iOS';

    const VALID_PLATFORMS = [
        self::ANDROID_PLATFORM,
        self::IOS_PLATFORM,
    ];

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * @param string $applicationId
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param CountryNormalizer $countryNormalizer
     * @param string $country
     */
    public function setCountry(CountryNormalizer $countryNormalizer, $country)
    {
        $this->country = $countryNormalizer->translateCode($country);
    }

    /**
     * @return double
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * @param PayoutTransformerInterface $payoutAdapter
     * @param double $value
     */
    public function setPayout(PayoutTransformerInterface $payoutAdapter, $value)
    {
        $this->payout = $payoutAdapter->getTransformerValue($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws \Exception
     */
    public function setName($name)
    {
        if (!$name) {
            throw new \Exception('name can not be null');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     * @throws \Exception
     */
    public function setPlatform($platform)
    {
        if (!in_array($platform, self::VALID_PLATFORMS)){
            throw new \Exception(sprintf('platform `%s` passed to setPlatform is not valid, valid are [%s]', $platform, join(',',self::VALID_PLATFORMS)));
        }
        $this->platform = $platform;
    }
}