<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;

class UsersController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->Authentication->allowUnauthenticated(['login','registration']);
	}
	
	public function login()
	{
		$this->set('title', 'Sign-in');
		$result = $this->Authentication->getResult();
		if ($result->isValid()) {
			$target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
			return $this->redirect($target);
		}
		if ($this->request->is('post')) {
			$this->Flash->error('Invalid username or password');
		}
	}
	
	public function logout()
	{
		$this->Authentication->logout();
		return $this->redirect(['controller' => 'Users', 'action' => 'login']);
	}
	
	public function registration()
    {
		
		$this->set('title', 'User Registration');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),['validate' => 'register']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    public function profile($slug = null)
    {
		$this->set('title', 'Account Details');
		/* $user = $this->Users->get($id, [
            'contain' => ['UserGroups', 
			//'Contacts', 'UserLogs'
			],
        ]); */
		//debug($slug);
		//exit;
		$this->loadModel('AuditLogs');
		
		
		
		$auditLogs = $this->AuditLogs->find('all')
			->where([
				'primary_key' => 11,
				//'category_id' => '1',
				])
			->order(['created' => 'ASC'])
			->limit(10);
		
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		
        /* $user = $this->Users->get($id, [
            ->contain(['UserGroups'])
        ]); */
		
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				//$log->setMetaInfo($log->getMetaInfo() + ['slug' => $user]);
				
			}
		});
//{"ip":"::1","url":"\/books\/appraisal-form\/7","user":1,"a_name":"Edit","c_name":"Books"}
//{"a_name":"Edit","c_name":"Users"}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			//$slug_name = $this->request->getData('slug');
		//debug($slug_name);
		//exit;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups','auditLogs'));
    }
}
