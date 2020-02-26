<?php

namespace App\Services;

class CsvFileReader
{
    const VALID_FILE_TYPES = ['text/csv'];

    /**
     * @param string $filename
     * @return array
     * @throws \Exception
     */
    public function readFile(string $filename): array
    {
        $this->checkFileType($filename);

        $fileData = [];
        $tmpName = $_FILES[$filename]['tmp_name'];
        if (($handle = fopen($tmpName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fileData[uniqid()] = $data;
            }
            fclose($handle);
        }

        return $fileData;
    }

    /**
     * @param string $filename
     * @throws \Exception
     */
    private function checkFileType(string $filename)
    {
        if (!in_array($_FILES[$filename]['type'], self::VALID_FILE_TYPES)) {
            throw new \Exception('Not valid file type');
        }
    }
}