<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.02.20
 * Time: 16:59
 */

namespace App\Controllers;

use App\Services\CsvFileReader;
use App\Services\StatisticsService;
use App\Services\StorageFileService;

class MainController
{

    /**
     * @var StatisticsService
     */
    private $statisticsService;
    /**
     * @var CsvFileReader
     */
    private $csvFileReader;
    /**
     * @var StorageFileService
     */
    private $storageFileService;

    public function __construct(
        StatisticsService $statisticsService,
        CsvFileReader $csvFileReader,
        StorageFileService $storageFileService
    )
    {

        $this->statisticsService = $statisticsService;
        $this->csvFileReader = $csvFileReader;
        $this->storageFileService = $storageFileService;
    }

    public function form()
    {
        include_once __ROOT__ .'/resources/form.php';
    }

    public function import()
    {
        try {
            $fileData = $this->csvFileReader->readFile('file');
        } catch (\Exception $e) {
            redirectTo('/');
        }

        $statistics = $this->statisticsService->buildStatistics($fileData);

        $this->storageFileService->writeFile('statistics.txt', serialize($statistics));

        redirectTo('/statistics');
    }
}