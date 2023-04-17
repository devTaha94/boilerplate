<?php

namespace App\Mappers;

class ProductTypeVariantMapper extends Mapper {

    /**
     * @param $item
     * @return array
     */
    protected function item($item): array
    {
        return [
            'id' => $item['variant_id'],
            'name' => ucfirst($item['name']),
            'unit' => $item['unit'],
        ];
    }
}
