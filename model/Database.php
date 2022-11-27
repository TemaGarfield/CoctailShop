<?php

namespace App\model;

use Aura\SqlQuery\QueryFactory;
use PDO;

class Database
{
    private PDO $pdo;
    private QueryFactory $queryFactory;

    public function __construct(PDO $pdo, QueryFactory $queryFactory)
    {
        $this->pdo = $pdo;
        $this->queryFactory = $queryFactory;
    }

    public function getAllFromTable($table): array
    {
        $select = $this->queryFactory->newSelect();
        $select
            ->cols(['*'])
            ->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToTable($table, $data): bool {
        $insert = $this->queryFactory->newInsert();
        $insert->into($table)->cols($data);

        $sth = $this->pdo->prepare($insert->getStatement());
        return $sth->execute($insert->getBindValues());
    }

    public function getFieldFromTable($table, $field): array {

        $select = $this->queryFactory->newSelect();
        $select->cols([$field])->from($table);
        $sth = $this->pdo->prepare($select->getStatement());
        $sth->execute($select->getBindValues());

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}