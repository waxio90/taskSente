<?php

namespace App\Service;

use Exception;

class OrderService
{

    private mixed $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @throws Exception
     */
    public function loadOrdersFromJson(): array
    {
        try {
            $jsonData = file_get_contents($this->filePath);
            $ordersData =  json_decode($jsonData, true);

            if ($ordersData === null) {
                throw new Exception('Niepoprawny format danych JSON.');
            }

            return $ordersData;
        } catch (Exception $e) {
            print $e->getMessage();
            return [];
        }
    }
}