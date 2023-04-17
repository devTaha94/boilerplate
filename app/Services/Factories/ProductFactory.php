<?php

namespace App\Services\Factories;

use App\Services\Repository\Book;
use App\Services\Repository\Dvd;
use App\Services\Repository\Furniture;
use App\Services\Repository\Product;

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
