<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Builders\RoomBuilder;

class RoomRepository extends PDOAbstract
{
    public function __construct()
    {
        parent::__construct(
            "INSERT INTO Room (id, blindtest_id)
                      SELECT :new_id, :blindtest_id FROM dual
                      WHERE :new_id NOT IN (SELECT id FROM room)
                      LIMIT 1",
            "UPDATE Room SET blindtest_id=:blindtestId WHERE id=:id"
        );
    }

    public function getTableName(): string
    {
        return "Room";
    }

    public function buildModel($result)
    {
        $builder = new RoomBuilder();
        return $builder
            ->setId($result['id'])
            ->setBlindtestId($result['blindtest_id'])
            ->build();
    }

    public function persist($entity)
    {
        $newId = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        try {
            $this->persistPS->bindParam('blindtest_id', $entity->getBlindtestId());
            $this->persistPS->bindParam('new_id', $newId);
            $result = $this->persistPS->execute();
            if($result) {
                return $this->find($newId);
            }
        } catch (\ErrorException $e) {
            dd($e);
        }
    }

    public function update($entity)
    {
        try {
            $this->updatePS->bindParam('blindtestId', $entity->getBlindtestId());
            $this->updatePS->bindParam('id', $entity->getId());
        } catch (\ErrorException $e) {
            dd($e);
        }
        return parent::update($entity);
    }
}