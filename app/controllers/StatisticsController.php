<?php


namespace App\Controllers;


use App\Exceptions\File\FileNotFoundException;
use App\Services\StorageFileService;

class StatisticsController
{
    /**
     * @var StorageFileService
     */
    private $storageFileService;

    public function __construct(StorageFileService $storageFileService)
    {
        $this->storageFileService = $storageFileService;
    }

    public function statistics()
    {
        try {
            $statistics = $this->storageFileService->readFile('statistics.txt');
            $statistics = unserialize($statistics);
        } catch (FileNotFoundException $e) {
            $statistics = [];
        }


        include_once __ROOT__ .'/resources/statistics.php';
    }
}