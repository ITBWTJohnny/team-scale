<?php


namespace App\Services;


use App\Models\GeoName;

class PhoneContinentDetector
{
    private $continentsByPhonePrefix;

    public function __construct(GeoName $geoName)
    {
        $this->continentsByPhonePrefix = $geoName->getALl();
    }

    public function detectContinent(string $phone): ?string
    {
        $prefix = substr($phone, 0, 4);
        $prefixLen3 = substr($prefix,0, 3);
        $prefixLen2 = substr($prefix,0, 2);
        $prefixLen1 = substr($prefix,0, 1);
        $continentCode = null;

        if (!empty($this->continentsByPhonePrefix[$prefix])) {
            $continentCode = $this->continentsByPhonePrefix[$prefix];
        } else if (!empty($this->continentsByPhonePrefix[$prefixLen3])) {
            $continentCode = $this->continentsByPhonePrefix[$prefixLen3];
        } else if (!empty($this->continentsByPhonePrefix[$prefixLen2])) {
            $continentCode = $this->continentsByPhonePrefix[$prefixLen2];
        } else if (!empty($this->continentsByPhonePrefix[$prefixLen1])) {
            $continentCode = $this->continentsByPhonePrefix[$prefixLen1];
        }

        return $continentCode;
    }
}