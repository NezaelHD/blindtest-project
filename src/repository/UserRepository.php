<?php

namespace App\Repository;

use App\PDO\PDOAbstract;
use Models\Builders\UserBuilder;

class UserRepository extends PDOAbstract {

    public function __construct(){
        parent::__construct(
            "INSERT INTO User(email, name, avatar, password, isAdmin) VALUES (:email, :name, :avatar, :password, :admin)",
            "UPDATE User SET email=:email, name=:name, avatar=:avatar, password=:password, isAdmin=:admin  WHERE id=:id");
    }

    function getTableName(): string
    {
        return "User";
    }

    function buildModel($result)
    {
        $builder = new UserBuilder();
        return $builder
            ->setEmail($result['email'])
            ->setAvatar($result['avatar'])
            ->setIsAdmin($result['isAdmin'])
            ->setPassword($result['password'])
            ->setName($result['name'])
            ->setId($result['id'])
            ->build();
    }

    public function persist($entity){
        try{
            $hashedPassword = password_hash($entity->getPassword(), PASSWORD_BCRYPT);
            $isAdmin = json_encode(intval($entity->isAdmin()));
            $this->persistPS->bindParam('email', $entity->getEmail());
            $this->persistPS->bindParam('name', $entity->getName());
            $this->persistPS->bindParam('avatar', $entity->getAvatar());
            $this->persistPS->bindParam('password', $hashedPassword);
            $this->persistPS->bindParam('admin', $isAdmin);
        } catch (\ErrorException $e) {
            dd($e);
        }
        return parent::persist($entity);
    }

    public function update($entity) {
    try{
        $this->updatePS->bindParam('email', $entity->getEmail());
        $this->updatePS->bindParam('name', $entity->getName());
        $this->updatePS->bindParam('avatar', $entity->getAvatar());
        $this->updatePS->bindParam('password', $entity->getPassword());
        $this->updatePS->bindParam('admin', $entity->isAdmin());
        $this->updatePS->bindParam('id', $entity->getId());
    } catch (\ErrorException $e) {
        dd($e);
    }
        return parent::update($entity);
    }
}
