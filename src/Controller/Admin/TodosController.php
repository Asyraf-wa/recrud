<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Todos Controller
 *
 * @property \App\Model\Table\TodosTable $Todos
 * @method \App\Model\Entity\Todo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TodosController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['search'],
		]);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'To Do Task');
        $this->paginate = [
            'contain' => ['Users'],
        ];
        //$todos = $this->paginate($this->Todos);
		$todos = $this->paginate($this->Todos->find('search', ['search' => $this->request->getQuery()]));
		
		$todos_pending = $this->Todos->find('all')
			->where([
				'status' => 'Pending',
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);
			
		$todos_progress = $this->Todos->find('all')
			->where([
				'status' => 'In Progress',
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);
			
		$todos_completed = $this->Todos->find('all')
			->where([
				'status' => 'Completed',
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);

		$todos_canceled= $this->Todos->find('all')
			->where([
				'status' => 'Canceled',
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);
			
		$users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todos','todos_pending','todos_progress','todos_completed','todos_canceled','users'));
    }

    /**
     * View method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('todo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Task');
        $todo = $this->Todos->newEmptyEntity();
        if ($this->request->is('post')) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
			$todo->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id');
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Update Task Information');
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }
	
	public function toProgress($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
			$todo->status = 'In Progress'; //In Progress
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }
	
	public function toCompleted($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
			$todo->status = 'Completed'; 
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }
	
	public function toPending($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
			$todo->status = 'Pending'; 
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }
	
	public function toCanceled($id = null)
    {
        $todo = $this->Todos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
			$todo->status = 'Canceled'; 
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('todo', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $todo = $this->Todos->get($id);
        if ($this->Todos->delete($todo)) {
            $this->Flash->success(__('The todo has been deleted.'));
        } else {
            $this->Flash->error(__('The todo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
