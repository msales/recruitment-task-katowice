<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 15:50
 */

namespace Recruitment\ApiBundle\Services\Normalizers\Country;

class CountryNormalizer
{
    protected $base;
    protected $countries;
    const COUNTRIES_FILE = __DIR__ . '/countries.txt';
    const ISO_ALPHA2 = 'alpha2';
    const ISO_ALPHA3 = 'alpha3';
    const ISO_M49 = 'm49';

    const ISO_KEYS = [
        self::ISO_ALPHA2,
        self::ISO_ALPHA3,
        self::ISO_M49,
    ];

    /**
     * CountryNormalizer constructor.
     * @param string $base the ISO that will be used to fetch countries
     * @throws \Exception
     */
    public function __construct($base = self::ISO_ALPHA2)
    {
        if (!in_array($base, self::ISO_KEYS)){
            throw new \Exception("base `{$base}` passed to CountryNormalizer constructor should be in [".join(',', self::ISO_KEYS).']');
        }
        $this->base = $base;
        $this->countries = [];
        $handle = fopen(self::COUNTRIES_FILE, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $country = preg_split("/\t/", $line);
                if (count($country) ==4) { // others are informative lines
                    $this->countries[] = [
                        'name' => $country[0],
                        self::ISO_ALPHA2 => $country[1],
                        self::ISO_ALPHA3 => $country[2],
                        self::ISO_M49 => $country[3],
                    ];
                }
            }
            fclose($handle);
        } else {
            throw new \Exception(sprintf('File `%s` absent or unreadable.', self::COUNTRIES_FILE));
        }
    }

    /**
     * @param string $code
     * @return array
     * @throws \Exception
     */
    public function getCountry($code)
    {
        foreach($this->countries as $country) {
            if($country[$this->base] == $code){
                return $country;
            }
        }

        throw new \Exception(sprintf('there is no country with `%s`==`%s`', $this->base, $code));
    }

    /**
     * @param string $unknown
     * @param string|null $toCode
     * @return string
     * @throws \Exception
     */
    public function translateCode($unknown, $toCode = null)
    {
        if (null === $toCode) {
            $toCode = $this->base;
        }
        if (!in_array($toCode, self::ISO_KEYS)){
            throw new \Exception("toCode `{$toCode}` passed to CountryNormalizer::translateCode should be in [".join(',', self::ISO_KEYS).']');
        }

        foreach(self::ISO_KEYS as $keyCode){
            foreach ($this->countries as $country) {
                if ($country[$keyCode] == $unknown) {
                    return $country[$toCode];
                }
            }
        }

        throw new \Exception(sprintf('there is no country represented by `%s`', $unknown));
    }
}