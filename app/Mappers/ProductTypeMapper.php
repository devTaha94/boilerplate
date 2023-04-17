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
            'alias' => $item['alias'],
            'name' => ucfirst($item['alias']),
            'description' => $item['description'],
        ];
    }
}
