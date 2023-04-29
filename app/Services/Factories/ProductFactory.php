<?php

namespace app\Services\Factories;

use app\Services\Repository\Book;
use app\Services\Repository\Dvd;
use app\Services\Repository\Furniture;
use app\Services\Repository\Product;

class ProductFactory
{
    /**
     * @param string $type
     * @return Book|Dvd|Furniture
     * @throws \Exception
     */
    public static function create( string $type): Product
    {
        switch ($type) {
            case 'dvd':
                return new Dvd();
            case 'book':
                return new Book();
            case 'furniture':
                return new Furniture();
            default:
                throw new \Exception('Invalid product type.');
        }
    }
}
