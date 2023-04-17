<?php

namespace App\Controllers;

use App\Mappers\ProductTypeMapper;
use DB;

class ProductTypesController
{
    public function index()
    {
        $query = DB::query('SELECT * FROM product_types')->get();
        $results = (new ProductTypeMapper($query))->collect();
        return success_response('', $results);
    }
}
