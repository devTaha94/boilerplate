<?php

namespace App\Controllers;

use App\Services\Factories\ProductFactory;
use App\Services\Repository\Product;
use App\Validators\ProductValidator;
use App\Validators\DeleteProductValidator;

class ProductController extends Controller
{
    public function index()
    {
        $results = [];
        $products = Product::getAll();
        foreach ($products as $item) { // Make use of oop polymorphism & avoid conditions for displaying different product types.
            $class = '\\App\Services\Repository\\' . ucfirst($item['type']);
            $product = new $class;
            $product->setId($item['id']);
            $product->setSku($item['sku']);
            $product->setName($item['name']);
            $product->setMeasurement($item['measurement']);
            $product->setPrice($item['price']);
            $product->setOptions($product->fetchOptions($item['id']));
            $results[] = $product->display();
        }
        return success_response('', $results);
    }

    public function store()
    {
        try {
            $data = (new ProductValidator())->validate($_POST);
            // as we have multiple products type, it will be good to use factory design pattern.
            $product = ProductFactory::create($data['type']);
            $product->setSku($data['sku']);
            $product->setType($data['type']);
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $product->setOptions($data['options']);
            $product->setProductTypeId($data['product_type_id']);
            $product->save();
            return success_response('Product has been created successfully');
        } catch (\Exception $exception) {
            return bad_response($exception->getMessage());
        }
    }

    public function deleteAll()
    {
        try {
            $data = (new DeleteProductValidator())->validate($_POST);
            Product::deleteAll($data['productIds']);
            return success_response('Product has been added successfully');
        } catch (\Exception $exception) {
            return bad_response($exception->getMessage());
        }
    }
}
