<?php

namespace App\Services\Repository;

use App\Services\Interfaces\ProductInterface;
use DB;

abstract class Product implements ProductInterface
{

    protected static string $table = 'products';
    protected int $id;
    protected string $sku;
    protected string $name;
    protected string $type;
    protected string $measurement;
    protected float $price;
    protected array $options;
    protected int $product_type_id;

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $sku
     * @return void
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param int $product_type_id
     * @return void
     */
    public function setProductTypeId(int $product_type_id): void
    {
        $this->product_type_id = $product_type_id;
    }

    /**
     * @param string $measurement
     * @return void
     */
    public function setMeasurement(string $measurement): void
    {
        $this->measurement = $measurement;
    }

    /**
     * @param array $options
     * @return void
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getProductTypeId(): int
    {
        return $this->product_type_id;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
       return $this->options;
    }


    /**
     * @param int $product_id
     * @return array
     */
    public function fetchOptions(int $product_id): array
    {
         return DB::query('SELECT product_variant_values.value FROM product_variant_values LEFT JOIN variants on product_variant_values.variant_id = variants.id WHERE product_variant_values.product_id = ' . $product_id . ';')->get();
    }

    /**
     * @param array $productIds
     * @return void
     */
    public static function deleteAll(array $productIds): void
    {
        $ids = implode("','", $productIds);
        DB::beginTransaction();
        try {
            DB::query("DELETE FROM " . self::$table . " WHERE id IN ('" . $ids . "')");
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public static function getAll(): array
    {
        return DB::query("SELECT p.id, p.sku, p.name, p.price, p.type, pt.measurement, pt.unit FROM " . self::$table . " p LEFT JOIN product_types pt ON p.product_type_id = pt.id;")->get();
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $insert = DB::query(
                'INSERT INTO ' . self::$table . ' (sku, name, price, product_type_id, type)
                       VALUES (?, ?, ?, ?, ?)', $this->getSku(), $this->getName(), $this->getPrice(), $this->getProductTypeId(), $this->getType());

            if (count($this->options) > 0) { // Save product variants.
                $params = [];
                foreach ($this->options as $option) { // Prepare statement to insert bulk to db.
                    $params[] = '(' . $insert->lastInsertID() . ',' . $option['variant_id'] . ',' . $option['value'] . ')';
                }
                $ids = implode(', ', $params);
                DB::query('INSERT INTO product_variant_values (product_id, variant_id, value) VALUES ' . $ids);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public abstract function display(): array;
}