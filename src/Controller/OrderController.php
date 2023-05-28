<?php

namespace App\Controller;

use App\Service\OrderService;
use App\Service\SortService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private array $ordersData;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly OrderService $orderService,
        private readonly SortService $sortService
    )
    {
        $this->ordersData = $this->orderService->loadOrdersFromJson();
    }

    /**
     * @throws Exception
     */
    #[Route('/', name: 'list_orders')]
    public function listOrders(): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $this->ordersData,
        ]);
    }

    #[Route('/{name}', name: 'sort_list_orders')]
    public function sortListOrders(Request $request): Response
    {
        $sortParameters = [
            'sort_column' => $request->get('sort_column'),
            'sort_direction' => $request->get('sort_direction')
        ];

        $ordersData = $this->sortService->sortOrdersByParameters($sortParameters, $this->ordersData);

        return $this->render('orders/index.html.twig', [
            'orders' => $ordersData,
            'sort' => $sortParameters,
        ]);
    }
}
