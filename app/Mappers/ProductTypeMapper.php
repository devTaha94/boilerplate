<?php

namespace App\Mappers;

class ProductTypeMapper extends Mapper {

    /**
     * @param $item
     * @return array
     */
    protected function item($item): array
    {
        return [
            'id' => $item['id'],
            'name' => ucfirst($item['alias']),
            'alias' => $item['alias'],
            'unit' => $item['unit'],
            'description' => $item['description'],
        ];
    }
}
