<?php


namespace App\Services;


use App\Exceptions\File\FileNotFoundException;
use http\Encoding\Stream\Inflate;

class StorageFileService
{
    CONST STORAGE_PATH =  __ROOT__ .'/storage/';

    public function readFile(string $filename): string
    {
        $filepath = self::STORAGE_PATH . $filename;

        if (file_exists($filepath)) {
            return file_get_contents($filepath);
        }

        throw new FileNotFoundException('File '.$filename. ' - not found');
    }

    public function writeFile(string $filename, string $data)
    {
        $filepath = self::STORAGE_PATH . $filename;
        file_put_contents($filepath, $data);
    }
}