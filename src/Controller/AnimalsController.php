<?php

namespace App\Controller;

use App\Lib\Manager;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Class AnimalsController
 * @package App\Controller
 */
class AnimalsController extends AppController
{

    /**
     * @param \Cake\Event\Event $event
     *
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setTemplate('/Pages/home');

        $Manager = new Manager(ConnectionManager::get('default'));
        $Manager->flush();

        $Manager = new Manager(ConnectionManager::get('shard'));
        $Manager->flush();

        return parent::beforeFilter($event);
    }

    /**
     * This will result:
     * - 1 animal and 2 dogs in default connection database
     * - 0 animals and 1 dog in shard connection database
     */
    public function createFailure()
    {
        $Manager = new Manager(ConnectionManager::get('default'));
        $Manager->create();

        $Manager = new Manager(ConnectionManager::get('shard'));
        $Manager->create();
    }

    /**
     * This will result:
     * - 1 animal and 1 dogs in default connection database
     * - 1 animals and 1 dog in shard connection database
     */
    public function createSuccess()
    {
        $Manager = new Manager(ConnectionManager::get('default'));
        $Manager->create();

        TableRegistry::clear();
        TableRegistry::get('Dogs', ['connectionName' => 'shard']);

        $Manager = new Manager(ConnectionManager::get('shard'));
        $Manager->create();
    }

    /**
     * This will delete:
     * - Animal from default connection database
     * - Dog from shard connection database
     */
    public function deleteFailure()
    {
        $this->createSuccess();

        $DefaultManager = new Manager(ConnectionManager::get('default'));
        $DefaultManager->delete(1);
    }

    /**
     * This will delete records only from default connection database
     */
    public function deleteSuccess()
    {
        $this->createSuccess();

        TableRegistry::clear();
        TableRegistry::get('Dogs', ['connectioName' => 'default']);

        $DefaultManager = new Manager(ConnectionManager::get('default'));
        $DefaultManager->delete(1);
    }
}
