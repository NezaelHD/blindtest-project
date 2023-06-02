<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Builders\ScoreboardBuilder;

class ScoreboardRepository extends PDOAbstract
{
    public function __construct()
    {
        parent::__construct(
            "INSERT INTO Scoreboard(score, blindtest_id, user_id) VALUES (:score, :blindtestId, :userId)",
            "UPDATE Scoreboard SET score=:score, blindtest_id=:blindtestId, user_id=:userId WHERE id=:id"
        );
    }

    public function getTableName(): string
    {
        return "Scoreboard";
    }

    public function buildModel($result)
    {
        $builder = new ScoreboardBuilder();
        return $builder
            ->setScore($result['score'])
            ->setBlindtestId($result['blindtest_id'])
            ->setUserId($result['user_id'])
            ->setId($result['id'])
            ->build();
    }

    public function persist($entity)
    {
        try {
            $this->persistPS->bindParam('score', $entity->getScore());
            $this->persistPS->bindParam('blindtestId', $entity->getBlindtestId());
            $this->persistPS->bindParam('userId', $entity->getUserId());
        } catch (\ErrorException $e) {
            dd($e);
        }

        return parent::persist($entity);
    }

    public function update($entity)
    {
        try {
            $this->updatePS->bindParam('score', $entity->getScore());
            $this->updatePS->bindParam('blindtestId', $entity->getBlindtestId());
            $this->updatePS->bindParam('userId', $entity->getUserId());
            $this->updatePS->bindParam('id', $entity->getId());
        } catch (\ErrorException $e) {
            dd($e);
        }

        return parent::update($entity);
    }
}