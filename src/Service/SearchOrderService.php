<?php

namespace App\Service;

use Exception;

class SearchOrderService
{
    public function searchOrderFromListOrders(string $parameter, array $orders): array
    {
        try {
            $searchOrders = $this->searchOrdersByRefOrSymbol($parameter, $orders);

            if (empty($searchOrders)) {
                throw new Exception('Brak wyników dla podanej wartości: ' . $parameter);
            }

            return $searchOrders;
        } catch (Exception $e) {
            print $e->getMessage();
            return [];
        }
    }

    /**
     * @throws Exception
     */
    private function searchOrdersByRefOrSymbol(string $parameter, array $orders): array
    {
        $this->checkParameterToSearching($parameter);

        return $this->searchingOrders($parameter, $orders);
    }

    /**
     * @throws Exception
     */
    private function checkParameterToSearching(string $parameter): void
    {
        $pattern = '/^(?:Z\/)?[\d\/]+$/';

        if (empty($parameter)) {
            throw new Exception('Niepodano szukanego ref lub symbolu zamówienia.');
        }
        if (strlen($parameter) < 3) {
            throw new Exception('Podano za mało znaków. Minimalnie należy podać 3 znaki.');
        }
        if (!preg_match($pattern, $parameter)) {
            throw new Exception(
                'Podano nieprawidłowy ciąg znaków. Dopuszczalne znaki: cyfry "0-9","Z" oraz "/"'
            );
        }
    }

    private function searchingOrders(string $parameter, array $orders): array
    {
        $findOrders = [];
        foreach ($orders as $order) {
            $ref = (string) $order['ref'];
            $symbol = (string) $order['symbol'];

            if (str_contains($ref, $parameter)) {
                $findOrders[] = $order;
            } elseif (str_contains($symbol, $parameter)) {
                $findOrders[] = $order;
            }
        }
        return $findOrders;
    }
}