<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testBookEntity()
    {
        $book = new Book();

        $title = "Test Title";
        $book->setTitle($title);
        $this->assertEquals($title, $book->getTitle());

        $isbn = "1234567890123";
        $book->setIsbn($isbn);
        $this->assertEquals($isbn, $book->getIsbn());

        $author = "Test Author";
        $book->setAuthor($author);
        $this->assertEquals($author, $book->getAuthor());

        $image = "Test Image";
        $book->setImage($image);
        $this->assertEquals($image, $book->getImage());
    }
}
