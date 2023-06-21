<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../Services/OrdersService.class.php';

final class CreateOrderTest extends TestCase
{
    public function testCreateOrder(): void
    {
        $orderService = new OrdersService();

        $orderDescriptor = [
        'book_name' => 'Red Rising',
        'Order_Amount' => 5,
        'Date_of_Order' => '2023-06-21',
        'Date_of_Delivery' => '2023-06-25',
        'User_Name' => 'Dorijan',
        'User_Last_Name' => 'Komšić'
    ];

    $result = $orderService->addOrderWithUser($orderDescriptor);
    
    $this->assertNotNull($result);

    $this->assertEquals("Red Rising 2", $result['book_name']);
    
    }
}

