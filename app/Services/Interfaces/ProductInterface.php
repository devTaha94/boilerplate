<?php

namespace App\Services\Interfaces;


interface ProductInterface {

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param string $sku
     * @return void
     */
    public function setSku(string $sku): void;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void;

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void;

    /**
     * @param int $product_type_id
     * @return void
     */
    public function setProductTypeId(int $product_type_id): void;

    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options): void;
    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getProductTypeId(): int;

    /**
     * @return array
     */
    public function getOptions(): array;

    /**
     * delete bulk of product ids.
     * @param array $productIds
     * @return void
     */
    public static function deleteAll(array $productIds): void;

    /**
     * @param string $measurement
     * @return void
     */
    public function setMeasurement(string $measurement): void;

    /**
     * @return array
     */
    public static function getAll(): array;

    /**
     * @return mixed
     */
    public function save();
}