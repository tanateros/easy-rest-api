<?php

namespace App\Model\Repository;

class EntityManager
{
    protected $pdo;

    /**
     * EntityManager constructor.
     */
    public function __construct()
    {
        $config = parse_ini_file(__DIR__ . '/../../../config/config.ini');
        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO($dsn, $config['db_user'], $config['db_pass'], $opt);
    }

    /**
     * @param $repository
     *
     * @return AbstractRepository
     */
    public function getRepository($repository)
    {
        $repositoryClass = __NAMESPACE__ . "\\" . $repository . 'Repository';

        return new $repositoryClass($this->pdo);
    }
}
