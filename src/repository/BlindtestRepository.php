<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Blindtest;
use Models\Builders\BlindtestBuilder;

class BlindtestRepository extends PDOAbstract
{
    public function __construct()
    {
        parent::__construct(
            "INSERT INTO Blindtest(name, description, author) VALUES (:name, :description, :author)",
            "UPDATE Blindtest SET name=:name, description=:description, author=:author WHERE id=:id"
        );
    }

    public function getTableName(): string
    {
        return "Blindtest";
    }

    public function buildModel($result)
    {
        $builder = new BlindtestBuilder();
        return $builder
            ->setName($result['name'])
            ->setDescription($result['description'])
            ->setAuthor($result['author'])
            ->setId($result['id'])
            ->build();
    }

    public function persist($entity)
    {
        $this->persistPS->bindParam('name', $entity->getName());
        $this->persistPS->bindParam('description', $entity->getDescription());
        $this->persistPS->bindParam('author', $entity->getAuthor());

        return parent::persist($entity);
    }

    public function update($entity)
    {
        $this->updatePS->bindParam('name', $entity->getName());
        $this->updatePS->bindParam('description', $entity->getDescription());
        $this->updatePS->bindParam('author', $entity->getAuthor());
        $this->updatePS->bindParam('id', $entity->getId());

        return parent::update($entity);
    }
}