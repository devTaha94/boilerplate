<?php

namespace App\Validators;

use Exception;

class DeleteProductValidator
{
    private array $errors = [];

    private array $rules = [
        'productIds' => ['validator' => 'validateProductIds', 'message' => 'Deleted ids are required.']
    ];


    /**
     * @param $productIds
     * @return bool
     */
    public static function validateProductIds($productIds): bool
    {
        return !empty($productIds) && is_array($productIds);
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