<?php

namespace App\Controller;

use App\Service\OrderService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    public function __construct(
        private readonly OrderService $orderService
    )
    {
    }

    /**
     * @throws Exception
     */
    #[Route('/', name: 'list_order')]
    public function listOrder(): Response
    {
        $orderData = $this->orderService->loadOrdersFromJson();

        return $this->render('order/index.html.twig', [
            'orders' => $orderData,
        ]);
    }
}
