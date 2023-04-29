<?php

namespace App\Services\Repository;

class Furniture extends Product
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
            'price' => $this->price,
            'option_unit' => 'Dimensions',
            'option_value' => $this->mapOptions($this->options) // This can be customized anyway
        ];
    }

    /**
     * @param array $options
     * @return string
     */
    private function mapOptions(array $options): string
    {
        $option_value = '';
        foreach ($options as $option) {
            $option_value .= 'x' . $option['value'];
        }
        return ltrim($option_value, 'x');
    }
}
