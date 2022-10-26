<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserGroups Controller
 *
 * @property \App\Model\Table\UserGroupsTable $UserGroups
 * @method \App\Model\Entity\UserGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserGroupsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userGroups = $this->paginate($this->UserGroups);

        $this->set(compact('userGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userGroup = $this->UserGroups->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userGroup'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userGroup = $this->UserGroups->newEmptyEntity();
        if ($this->request->is('post')) {
            $userGroup = $this->UserGroups->patchEntity($userGroup, $this->request->getData());
            if ($this->UserGroups->save($userGroup)) {
                $this->Flash->success(__('The user group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user group could not be saved. Please, try again.'));
        }
        $this->set(compact('userGroup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userGroup = $this->UserGroups->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userGroup = $this->UserGroups->patchEntity($userGroup, $this->request->getData());
            if ($this->UserGroups->save($userGroup)) {
                $this->Flash->success(__('The user group has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user group could not be saved. Please, try again.'));
        }
        $this->set(compact('userGroup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Group id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userGroup = $this->UserGroups->get($id);
        if ($this->UserGroups->delete($userGroup)) {
            $this->Flash->success(__('The user group has been deleted.'));
        } else {
            $this->Flash->error(__('The user group could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
