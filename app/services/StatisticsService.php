<?php


namespace App\Services;


class StatisticsService
{
    /**
     * @var PhoneContinentDetector
     */
    private $phoneContinentDetector;
    /**
     * @var IpContinentDetector
     */
    private $ipContinentDetector;

    public function __construct(PhoneContinentDetector $phoneContinentDetector, IpContinentDetector $ipContinentDetector)
    {
        $this->phoneContinentDetector = $phoneContinentDetector;
        $this->ipContinentDetector = $ipContinentDetector;
    }

    public function buildStatistics(array $fileData): array
    {
        $statistics = [];
        $continentByIpArray = [];
        $continentByPhoneArray = [];
        foreach ($fileData as $id => $item) {
            [$customerId, ,$duration, $phone, $ip] = $item;

            if (!empty($continentByPhoneArray[$phone])) {
                $continentCodeByPhone = $continentByPhoneArray[$phone];
            } else {
                $continentCodeByPhone = $this->phoneContinentDetector->detectContinent($phone);
            }

            if (!empty($continentByIpArray[$ip])) {
                $continentCodeByIp = $continentByIpArray[$ip];
            } else {
                $continentCodeByIp = $this->ipContinentDetector->detectContinent($ip);
            }

            if (empty($statistics[$customerId])) {
                $customerData = [
                    'call_count' => 0,
                    'duration' => 0,
                    'same_continent_call_count' => 0,
                    'same_continent_duration' => 0,
                ];

            } else {
                $customerData = $statistics[$customerId];
            }

            $customerData['call_count'] += 1;
            $customerData['duration'] += $duration;
            if ($continentCodeByIp === $continentCodeByPhone) {
                $customerData['same_continent_call_count'] += 1;
                $customerData['same_continent_duration'] += $duration;
            }

            $statistics[$customerId] = $customerData;
        }

        return $statistics;
    }
}