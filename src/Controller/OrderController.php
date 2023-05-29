<?php

namespace App\Controller;

use App\Service\OrderService;
use App\Service\SearchOrderService;
use App\Service\SortOrderService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private array $ordersData;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly OrderService $orderService,
        private readonly SortOrderService $sortOrderServiceService,
        private readonly SearchOrderService $searchOrderService
    )
    {
        $this->ordersData = $this->orderService->loadOrdersFromJson();
    }

    #[Route('', name: 'list_orders')]
    public function listOrders(): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $this->ordersData,
        ]);
    }

    #[Route('/sort-list-orders', name: 'sort_list_orders')]
    public function sortListOrders(Request $request, SessionInterface $session): Response
    {
        $sessionKey = $request->query->get('sessionKey');
        $transferredListOrder = $session->get($sessionKey);
        $sortParameters = [
            'sort_column' => $request->get('sort_column'),
            'sort_direction' => $request->get('sort_direction')
        ];

        $ordersData = $this->sortOrderServiceService->sortOrdersByParameters($sortParameters, $transferredListOrder);

        return $this->render('orders/index.html.twig', [
            'orders' => $ordersData,
            'sort' => $sortParameters,
        ]);
    }

    #[Route('/search-orders', name: 'search_orders', methods: ['POST'])]
    public function searchOrders(Request $request): Response
    {
        $parameter = $request->request->get('search');
        $searchOrdersData = $this->searchOrderService->searchOrderFromListOrders($parameter, $this->ordersData);


        return $this->render('orders/index.html.twig', [
            'orders' => $searchOrdersData,
        ]);
    }
}
