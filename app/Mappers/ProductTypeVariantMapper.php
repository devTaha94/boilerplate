<?php

namespace app\Mappers;

class ProductTypeVariantMapper extends Mapper
{

    /**
     * @param $item
     * @return array
     */
    protected function item($item): array
    {
        return [
            'variant_id' => $item['variant_id'],
            'variant_name' => ucfirst($item['name']),
            'variant_alias' => $item['name'],
            'variant_type' => 'text' // Default, can be optimized from db
        ];
    }
}
