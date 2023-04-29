<?php

namespace app\Validators;

use Exception;
use DB;

class ProductValidator
{
    private array $errors = [];

    private array $rules = [
        'sku' => ['validator' => 'validateSku', 'message' => 'Product #sku is required unique.'],
        'name' => ['validator' => 'validateName', 'message' => 'Product #name is required.'],
        'price' => ['validator' => 'validatePrice', 'message' => 'Product #price is required.'],
        'product_type_id' => ['validator' => 'validateProductTypeId', 'message' => 'Product #type is invalid.'],
        'options' => ['validator' => 'validateOptions', 'message' => 'Product options are required'],
        'type' => ['validator' => 'validateType', 'message' => 'Product type is required'],
    ];


    /**
     * @param $sku
     * @return bool
     */
    public static function validateSku($sku): bool
    {
        $exists = DB::query("SELECT * FROM products WHERE sku = '".$sku."' LIMIT 1")->get();
        return !empty($sku) && count($exists) == 0;
    }

    /**
     * @param $name
     * @return bool
     */
    public static function validateName($name): bool
    {
        return !empty($name);
    }


    /**
     * @param $price
     * @return bool
     */
    public static function validatePrice($price): bool
    {
        return is_numeric($price);
    }

    /**
     * @param $product_type_id
     * @return bool
     */
    public static function validateProductTypeId($product_type_id): bool
    {
        // Todo:- Check existing in db.
        return !empty($product_type_id);
    }

    /**
     * @param $options
     * @return bool
     */
    public static function validateOptions($options): bool
    {
        return !empty($options) && is_array($options);
    }

    /**
     * @param $type
     * @return bool
     */
    public static function validateType($type): bool
    {
        return in_array($type, ['dvd', 'book', 'furniture']);
    }


    /**
     * @param array $request
     * @return void
     * @throws Exception
     */
    public function validate(array $request): array
    {
        $missingValues = array_diff_key($this->rules, $request); // Validate missing values
        if (count($missingValues)) throw new \Exception(array_values($missingValues)[0]['message']);

        $validated = [];
        foreach($request as $key => $value) { // Make sure values matches rules.
            if(isset($this->rules[$key])) {
                if(!self::{$this->rules[$key]['validator']}($value)) {
                    $this->errors[] = $this->rules[$key]['message'];
                }
                $validated[$key] = $value;
            }
        }

        if (count($this->errors)) { // Throw first exception
            throw new Exception($this->errors[0]);
        }
        return $validated;
    }
}