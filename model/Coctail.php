<?php

namespace App\model;

class Coctail
{
    private Database $database;

    private const TABLE_NAME = 'coctails';

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllCoctails(): array {
        return $this->database->getAllFromTable(self::TABLE_NAME);
    }
}