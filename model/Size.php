<?php

namespace App\model;

class Size
{

    private Database $database;

    private const TABLE_NAME = 'sizes';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllFromSizes(): array {
        return $this->database->getAllFromTable(self::TABLE_NAME);
    }

}