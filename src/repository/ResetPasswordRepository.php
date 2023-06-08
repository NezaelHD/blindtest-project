<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Builders\ResetPasswordBuilder;

class ResetPasswordRepository extends PDOAbstract {

    public function __construct(){
        parent::__construct(
            "INSERT INTO pwdReset(user_email, selector, token, expires) VALUES (:user_email, :selector, :token, :expires)",
            "UPDATE pwdReset SET user_email=:user_email, selector=:selector, token=:token, expires=:expires  WHERE id=:id");
    }

    function getTableName(): string
    {
        return "pwdReset";
    }

    function buildModel($result)
    {
        $builder = new ResetPasswordBuilder();
        return $builder
            ->setEmail($result['user_email'])
            ->setSelector($result['selector'])
            ->setToken($result['token'])
            ->setExpires($result['expires'])
            ->setId($result['id'])
            ->build();
    }

    public function persist($entity){
        try{
            $this->persistPS->bindParam('user_email', $entity->getEmail());
            $this->persistPS->bindParam('selector', $entity->getSelector());
            $this->persistPS->bindParam('token', $entity->getToken());
            $this->persistPS->bindParam('expires', $entity->getExpires());
        } catch (\ErrorException $e) {
            dd($e);
        }
        return parent::persist($entity);
    }

    public function update($entity) {
        try{
            $this->updatePS->bindParam('user_email', $entity->getEmail());
            $this->updatePS->bindParam('selector', $entity->getSelector());
            $this->updatePS->bindParam('token', $entity->getToken());
            $this->updatePS->bindParam('expires', $entity->getExpires());
            $this->updatePS->bindParam('id', $entity->getId());
        } catch (\ErrorException $e) {
            dd($e);
        }
        return parent::update($entity);
    }
}
