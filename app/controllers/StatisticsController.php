<?php


namespace App\Controllers;


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
        $statistics = $this->storageFileService->readFile('statistics.txt');
        $statistics = unserialize($statistics);

        include_once __ROOT__ .'/resources/statistics.php';
    }
}