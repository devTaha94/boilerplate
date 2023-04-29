<?php

namespace App\Mappers;

class Mapper
{

    protected array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function collect(): array
    {
        $results = [];
        foreach ($this->data as $item) {
            $results[] = $this->item($item);
        }
        return $results;
    }

    /**
     * @return array
     */
    public function map(): array
    {
        return $this->item($this->data);
    }
}