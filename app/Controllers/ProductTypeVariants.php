<?php

namespace app\Controllers;

use app\Mappers\ProductTypeVariantMapper;
use DB;

class ProductTypeVariants
{
    /**
     * @param $productTypeId
     * @return void
     */
    public function index($productTypeId)
    {
        $query = DB::query('SELECT
                    v.name,
                    ptv.variant_id
                FROM
                    product_types pt
                LEFT JOIN product_type_variants ptv ON
                    pt.id = ptv.product_type_id
                LEFT JOIN variants v ON
                    ptv.variant_id = v.id
                WHERE
                    pt.id = ?;',
            array($productTypeId))->get();
        $results = (new ProductTypeVariantMapper($query))->collect();
        return success_response('', $results);
    }
}
