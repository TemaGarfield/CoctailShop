<?php

namespace App\model;

class Converter
{

    private Database $database;
    private const TABLE_NAME = 'coctails';
    private const FIELD_NAME = 'price';
    private const PRECISION = 2;


    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function convert(bool $needToConvert, float $currencyOfficialRate): array {

        $prices = [];

        if ($needToConvert) {
            foreach ($this->database->getFieldFromTable(self::TABLE_NAME, self::FIELD_NAME) as $price) {
                $prices[] = round($price['price'] / $currencyOfficialRate, self::PRECISION);
            }
        } else {
            foreach ($this->database->getFieldFromTable('coctails', 'price') as $price){
                $prices[] = $price['price'];
            }
        }

        return $prices;
    }
}