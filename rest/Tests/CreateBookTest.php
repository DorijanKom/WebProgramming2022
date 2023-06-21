<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../Services/BooksService.class.php';

final class CreateBookTest extends TestCase
{
    public function testCreateBook()
    {
        $bookService = new BooksService();

        $book = ['Book_Name' => "Knjiga",
         'name' => "Egmont",
         'Year_of_publishing' => 2017,
         'Book_price' => 24.99,
         'In_inventory' => 23,
         'Writer_Name' => "J.D",
         'Writer_Last_Name' => "Salinger"
        ];

        $result = $bookService->addBookAndWriter($book);

        $this->assertNotNull($result);

        $this->assertEquals("Knjiga", $result['Book_Name']);

    }
}