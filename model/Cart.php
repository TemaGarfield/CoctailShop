<?php

namespace App\model;

class Cart
{

    private Database $database;

    private const TABLE_NAME = 'cart';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function addToCart(array $data): bool {
        return $this->database->addToTable(self::TABLE_NAME, $data);
    }

}