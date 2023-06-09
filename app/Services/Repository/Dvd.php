<?php

namespace app\Services\Repository;

class Dvd extends Product
{
    /**
     * @return array
     */
    public function display(): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'option_unit' => $this->measurement,
            'option_value' => $this->options[0]['value'] . ' ' . $this->unit // This can be customized anyway
        ];
    }
}
