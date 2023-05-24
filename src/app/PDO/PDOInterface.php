<?php

namespace App\PDO;

/**
 * Interface needed by the PDOAbstract class.
 * It allows us to be sure that all these functions will be implemented.
 */
interface PDOInterface {
    /**
     * @param int $id
     * @return mixed
     *
     * Method needed to find a row of the model.
     */
    public function find(int $id);

    /**
     * @return mixed
     *
     * Method needed to find all rows of the model.
     */
    public function findAll();

    /**
     * @param $entity
     * @return mixed
     *
     * Method needed to store a row of the model.
     */
    public function persist($entity);

    /**
     * @param $entity
     * @return mixed
     *
     * Method needed to update values of a row of the model.
     */
    public function update($entity);

    /**
     * @param $id
     * @return mixed
     *
     * Method needed to remove a row of the model.
     */
    public function remove($id);
}