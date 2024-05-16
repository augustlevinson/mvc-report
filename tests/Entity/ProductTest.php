<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductEntity()
    {
        $product = new Product();

        $name = "Test Product";
        $product->setName($name);
        $this->assertEquals($name, $product->getName());

        $value = 123;
        $product->setValue($value);
        $this->assertEquals($value, $product->getValue());
    }
}