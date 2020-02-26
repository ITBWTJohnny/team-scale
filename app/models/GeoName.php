<?php


namespace App\Models;


class GeoName
{
    private $dataPath = __ROOT__ .'/config/geoname.php';

    public function getALl(): ?array
    {
        $content = file_get_contents($this->dataPath);

        if ($content) {
            return unserialize($content);
        }

        return null;
    }
}