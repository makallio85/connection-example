<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dogs Controller
 *
 * @property \App\Model\Table\DogsTable $Dogs
 *
 * @method \App\Model\Entity\Dog[] paginate($object = null, array $settings = [])
 */
class DogsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Animals']
        ];
        $dogs = $this->paginate($this->Dogs);

        $this->set(compact('dogs'));
        $this->set('_serialize', ['dogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Dog id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dog = $this->Dogs->get($id, [
            'contain' => ['Animals']
        ]);

        $this->set('dog', $dog);
        $this->set('_serialize', ['dog']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dog = $this->Dogs->newEntity();
        if ($this->request->is('post')) {
            $dog = $this->Dogs->patchEntity($dog, $this->request->getData());
            if ($this->Dogs->save($dog)) {
                $this->Flash->success(__('The dog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dog could not be saved. Please, try again.'));
        }
        $animals = $this->Dogs->Animals->find('list', ['limit' => 200]);
        $this->set(compact('dog', 'animals'));
        $this->set('_serialize', ['dog']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dog id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dog = $this->Dogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dog = $this->Dogs->patchEntity($dog, $this->request->getData());
            if ($this->Dogs->save($dog)) {
                $this->Flash->success(__('The dog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dog could not be saved. Please, try again.'));
        }
        $animals = $this->Dogs->Animals->find('list', ['limit' => 200]);
        $this->set(compact('dog', 'animals'));
        $this->set('_serialize', ['dog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dog = $this->Dogs->get($id);
        if ($this->Dogs->delete($dog)) {
            $this->Flash->success(__('The dog has been deleted.'));
        } else {
            $this->Flash->error(__('The dog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
