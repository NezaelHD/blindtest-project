<?php

namespace App\PDO;

use \PDO;
use \PDOStatement;
use App\Database;

/**
 * Abstract class which will be extended by all model.
 * This allows methods to have basics request already working when created.
 */
abstract class PDOAbstract implements PDOInterface {
    /**
     * @var PDO|\App\PDO|null
     * Database connection retrieved with his singleton.
     */
    protected ?PDO $connection;

    /**
     * @var PDOStatement|null
     * Prepared request which allow the model to persist a row.
     */
    protected PDOStatement $persistPS;

    /**
     * @var PDOStatement|null
     * Prepared request which allow the model to update a row.
     */
    protected PDOStatement $updatePS;

    /**
     * @var PDOStatement|null
     * Prepared request which allow the model to find an element.
     */
    private PDOStatement $findPS;

    /**
     * @var PDOStatement|null
     * Prepared request which allow the model to retrieve all his data.
     */
    private PDOStatement $findAllPS;

    /**
     * @param string $persistPS
     * @param string $updatePS
     *
     * Constructor which allow to implement basics request in prepared statement.
     * An exception is thrown if there is any error during the database connection.
     */
    public function __construct(string $persistPS, string $updatePS){
        $tempConnection = null;
        $tempFindPS = null;
        $tempFindAllPS = null;
        $tempPersistPS = null;
        $tempUpdatePS = null;

        try {
            $tempConnection = Database::getInstance();
            $tempFindPS = $tempConnection->prepare("SELECT * FROM " . $this->getTableName() . " WHERE id=:id");
            $tempFindAllPS = $tempConnection->prepare("SELECT * FROM " . $this->getTableName());
            $tempPersistPS = $tempConnection->prepare($persistPS);
            $tempUpdatePS = $tempConnection->prepare($updatePS);
        } catch (\Exception $e){
            dd($e);
        }

        $this->connection = $tempConnection;
        $this->findPS = $tempFindPS;
        $this->findAllPS = $tempFindAllPS;
        $this->persistPS = $tempPersistPS;
        $this->updatePS = $tempUpdatePS;
    }

    /**
     * @return string
     *
     * Function to retrieve the table name of the model.
     * It has to be defined directly when the model is defined.
     */
    abstract function getTableName(): string;

    /**
     * @return mixed
     *
     * Function which transform result sent by the DB to an Object model.
     */
    abstract function buildModel(array $result);

    /**
     * @param int $id
     * @return mixed
     *
     * Find methods which retrieve values based on an id.
     */
    public function find(int $id) {
        try {
			$this->findPS->execute(['id'=>$id]);
            $results = $this->findPS->fetchAll();
			foreach ($results as $result){
                $entity = $this->buildModel($result);
            }
		} catch (\ErrorException $e) {
            dd($e);
        }
		return $entity;
	}

    /**
     * @param string $field
     * @param mixed $value
     * @return mixed
     *
     * FindBy methods which retrieve values based on the column on where searching and the value to search.
     */
    public function findBy(string $field, $value)
    {
        try {
            $query = $this->connection->prepare("SELECT * FROM " . $this->getTableName() . " WHERE " . $field . " = :value");
            $query->execute(['value' => $value]);
            $results = $query->fetchAll();
            $entities = [];
            foreach ($results as $result) {
                $entities[] = $this->buildModel($result);
            }
            return $entities;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @return array
     *
     * findAll methods which retrieve all the values in the DB.
     */
    public function findAll() {
        $entities = [];
        $this->findAllPS->execute();
		try {

            $results = $this->findAllPS->fetchAll();
			foreach ($results as $result){
                $entities[] = $this->buildModel($result);
            }
		} catch (\ErrorException $e) {
            dd($e);
        }
		return $entities;
	}

    /**
     * @return mixed
     *
     * Function which allow the model to save a row.
     */
    public function persist($entity) {
        $lastInsertId = -1;
		try {
            $result = $this->persistPS->execute();
            $lastInsertId = $this->connection->lastInsertId();
		} catch (\ErrorException $e) {
            dd($e);
        }
		return $this->find($lastInsertId);
	}

    /**
     * Function which allow the model to update a row.
     */
    public function update($entity) {
		try {
            $this->updatePS->execute();
        } catch (\Exception $e) {
            dd($e);
        }
	}

    /**
     * @param $id
     *
     * Function which remove a row based on his id.
     */
    public function remove($id)
    {
        try {
            $query = $this->connection->prepare("DELETE FROM " . $this->getTableName() . " WHERE ID=:id");
            $query->execute(['id' => $id]);
        } catch (\ErrorException $e) {
            dd($e);
        }
    }

}