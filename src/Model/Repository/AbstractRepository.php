<?php

namespace App\Model\Repository;

/**
 * Class AbstractRepository
 *
 * @package App\Model\Repository
 */
abstract class AbstractRepository
{
    /**
     * @var \PDO
     */
    protected $connect;

    /**
     * @var string
     */
    protected $table;

    /**
     * AbstractRepository constructor.
     *
     * @param $connect
     */
    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $data = $this->connect->query("SELECT * FROM " . $this->getTable());

        return $data->fetchAll();
    }

    /**
     * @return array
     */
    public function find($id)
    {
        $sql = "SELECT * FROM " . $this->getTable() . " WHERE id = :id";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
}
