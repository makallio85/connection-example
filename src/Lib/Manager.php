<?php

namespace App\Lib;

use Cake\Datasource\ConnectionInterface;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;
use Migrations\Migrations;

/**
 * Class Manager
 * @package App\Lib
 */
class Manager
{
    /**
     * @var \Cake\Datasource\ConnectionInterface
     */
    private $Connection;

    /**
     * Manager constructor.
     *
     * @param \Cake\Datasource\ConnectionInterface $Connection
     */
    public function __construct(ConnectionInterface $Connection)
    {
        $this->Connection = $Connection;
    }

    /**
     * @return \Cake\ORM\Table
     */
    private function getTable()
    {
        $TableLocator = new TableLocator();
        return $TableLocator->get('Animals', ['connectionName' => $this->Connection->config()['name']]);
    }

    /**
     * Create
     */
    public function create()
    {
        $AnimalsTable = $this->getTable();
        $entity       = $AnimalsTable->newEntity(
            [
                'name' => 'Dogs',
                'dogs' => [
                    ['name' => 'John'],
                ],
            ],
            [
                'associated' => ['Dogs'],
            ]
        );
        $AnimalsTable->save($entity);
    }

    /**
     * Delete
     *
     * @param int $animalId
     */
    public function delete(int $animalId)
    {
        $AnimalsTable = $this->getTable();
        $Animal       = $AnimalsTable->get($animalId);
        $AnimalsTable->delete($Animal);
    }

    /**
     * Flush all tables
     */
    public function flush()
    {
        $Migrations = new Migrations(['connection' => $this->Connection->config()['name']]);
        $Migrations->rollback(['date' => '2017-09-11']);
        $Migrations->migrate();
    }
}