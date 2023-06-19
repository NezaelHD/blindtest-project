<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Builders\BlindtestSongsBuilder;

class BlindtestSongsRepository extends PDOAbstract
{
    public function __construct()
    {
        parent::__construct(
            "INSERT INTO Blindtestsongs(url, answer, blindtest_id) VALUES (:url, :answer, :blindtestId)",
            "UPDATE Blindtestsongs SET url=:url, answer=:answer, blindtest_id=:blindtestId WHERE id=:id"
        );
    }

    public function getTableName(): string
    {
        return "Blindtestsongs";
    }

    public function buildModel($result)
    {
        $builder = new BlindtestSongsBuilder();
        return $builder
            ->setUrl($result['url'])
            ->setAnswer($result['answer'])
            ->setBlindtestId($result['blindtest_id'])
            ->setId($result['id'])
            ->build();
    }

    public function persist($entity)
    {
        try {
            $this->persistPS->bindParam('url', $entity->getUrl());
            $this->persistPS->bindParam('answer', $entity->getAnswer());
            $this->persistPS->bindParam('blindtestId', $entity->getBlindtestId());
        } catch (\ErrorException $e) {
            dd($e);
        }

        return parent::persist($entity);
    }

    public function update($entity)
    {
        try {
            $this->updatePS->bindParam('url', $entity->getUrl());
            $this->updatePS->bindParam('answer', $entity->getAnswer());
            $this->updatePS->bindParam('blindtestId', $entity->getBlindtestId());
            $this->updatePS->bindParam('id', $entity->getId());
        } catch (\ErrorException $e) {
            dd($e);
        }

        return parent::update($entity);
    }
}