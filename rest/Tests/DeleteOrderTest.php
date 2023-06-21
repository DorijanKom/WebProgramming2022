<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../Services/OrdersService.class.php';

final class DeleteOrderTest extends TestCase
{
    public function testDeleteOrder()
    {
        $orderService = new OrdersService();

        $ordersList = $orderService->getOrdersAndUsers();
        $ordersListSize = sizeof($orderService->getOrdersAndUsers());

        $lastOrder = $ordersList[$ordersListSize-1];
        $lastId = $lastOrder['id'];

        $this->assertNotNull($ordersList);
        
        $orderService->delete($lastId);

        $newOrdersListSize = sizeof($orderService->getOrdersAndUsers());

        $this->assertNotEquals($newOrdersListSize, $ordersListSize);
    }
}

