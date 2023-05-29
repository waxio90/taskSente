<?php

namespace App\Service;

use Exception;

class SortOrderService
{
    public function sortOrdersByParameters(array $sortParameters, array $listOrder): array
    {
        try {
            return $this->sortingListOrders($sortParameters, $listOrder);
        } catch (Exception $e) {
            print $e->getMessage();
            return [];
        }
    }

    /**
     * @throws Exception
     */
    private function sortingListOrders(array $sortParameters, array $orders): array
    {
        $sortColumn = $sortParameters['sort_column'];
        $sortDirection = $sortParameters['sort_direction'];
        $this->checkParametersToSorting($sortColumn,$sortDirection, $orders);

        usort($orders, function ($a, $b) use ($sortColumn, $sortDirection) {
            $comparison = $a[$sortColumn] <=> $b[$sortColumn];

            if ($sortDirection === 'desc') {
                $comparison *= -1;
            }
            return $comparison;
        });
        return $orders;
    }

    /**
     * @throws Exception
     */
    private function checkParametersToSorting(string $sortColumn, string $sortDirection, array $orders): void
    {
        if (empty($sortColumn) || empty($sortDirection)) {
            throw new Exception('Podano błędne parametry sortowania');
        }
        if (!in_array($sortColumn, array_keys($orders[0]))) {
            throw new Exception('Podana kolumna nie występuje w tabeli zamówień');
        }
        if ($sortDirection !== 'desc' && $sortDirection !== 'asc') {
            throw new Exception('Podano błędny kierunek sortowania');
        }
    }
}