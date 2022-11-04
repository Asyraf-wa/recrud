<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

use Cake\View\JsonView;
use Cake\View\XmlView;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Http\ServerRequest;

use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();
		
		$this->loadComponent('UserLogs');
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);

		$this->Authentication->allowUnauthenticated(['']);
	}
	
	public function index()
    {
		$this->set('title', 'User Management');
        $this->paginate = [
            'contain' => ['UserGroups'],
			'maxLimit' => 10,
        ];
        //$users = $this->paginate($this->Users);
		$users = $this->paginate($this->Users->find('search', ['search' => $this->request->getQuery()]));
		
		//count
		$this->set('total_users', $this->Users->find()->count());
		$this->set('total_users_archived', $this->Users->find()->where(['status' => 2])->count());
		$this->set('total_users_active', $this->Users->find()->where(['status' => 1])->count());
		$this->set('total_users_disabled', $this->Users->find()->where(['status' => 0])->count());
		
//Count By Month
	$this->set('january', $this->Users->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('february', $this->Users->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('march', $this->Users->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('april', $this->Users->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may', $this->Users->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun', $this->Users->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('july', $this->Users->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('august', $this->Users->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('september', $this->Users->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('october', $this->Users->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('november', $this->Users->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('december', $this->Users->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        $this->set(compact('users'));
    }
	
	public function resetPassword($token = null)
	{
		$this->set('title', 'Reset Password');
		$user = $this->Users->findByToken($token)->first();
		$password = $this->request->getData('password');

		if ($this->request->is(['post'])) {
			$user->password = $password;
			$user->token = '';
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your password has been successfully updated.'));
				return $this->redirect(['action' => 'login']);
			}
			$this->Flash->error(__('Your password could not be saved. Please, try again.'));
		}
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
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
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
				'primary_key' => $user->id,
				//'category_id' => '1',
				])
			->order(['created' => 'ASC'])
			->limit(10);
		
		
		
        /* $user = $this->Users->get($id, [
            ->contain(['UserGroups'])
        ]); */
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups','auditLogs'));
    }
	
	public function auditTrail($slug = null)
    {
		$this->set('title', 'Audit Trail');
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		$this->loadModel('AuditLogs');
		
		$auditLogs = $this->AuditLogs->find('all')
			->where([
				'primary_key' => $user->id,
				//'category_id' => '1',
				])
			->order(['created' => 'ASC'])
			->limit(10);
	
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups','auditLogs'));
    }
	
	public function update($slug = null)
	{
		$this->set('title', 'Update Profile');
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
			
			
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
				
			}
		});	
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups','auditLogs'));
	}
	
	public function removeAvatar($slug = null)
	{
		$this->set('title', 'Remove Profile Picture');
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
				//return $this->redirect($this->referer());
				return $this->redirect(['action' => 'profile', $user->slug]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups','auditLogs'));
	}
	
	public function changePassword($slug = null)
	{
		$this->set('title', 'Change Password');
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		
		//$userSlug = $this->Auth->user('slug');

		/* if($slug != $userSlug){
				$this->Flash->error(__('You are not authorized to view'));
				return $this->redirect(['action' => 'profile', $this->Auth->user('slug')]);
		} */
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),['validate' => 'password']);
			
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been updated.'));

                return $this->redirect(['action' => 'profile', $user->slug]);
            }
            $this->Flash->error(__('Your password could not be update. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'userGroups'));
		
	}
	
	public function activity($slug = null)
    {
		$this->set('title', 'User Activities');
		
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
			
		$this->loadModel('userLogs');
		$userLogs = $this->userLogs->find('all')
			->where([
				'user_id' => $user->id,
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(10);
		
        $this->set(compact('user','userLogs'));
			
		//$this->set(compact('user', 'userGroups'));
    }
	
	public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
				
			}
		});	
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function activate($slug = null)
	{
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 1;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been activated'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Cannot activate. Please, try again.'));
        }
	}
	
	public function disable($slug = null)
	{
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 0;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been disabled'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Cannot disable. Please, try again.'));
        }
	}
	
	public function adminVerify($slug = null)
	{
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_email_verified = 1;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been verified'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Cannot verified. Please, try again.'));
        }
	}
	
	public function archived($slug = null)
	{
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->status = 2;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been verified'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Cannot verified. Please, try again.'));
        }
	}
	
	public function resetToken($slug=null)
	{
		$user = $this->Users->get($slug, [
            'contain' => [],
        ]);
		$this->request->allowMethod(['post']);
		$user = $this->Users->get($slug);
		$token = $user->token;
		
		if($token == NULL)
		{
			$this->Flash->error(__('No token detected'));
			return $this->redirect($this->referer());
		}
		
		if($token != NULL)
		{
			$user->token = '';
		}
		
		if($this->Users->save($user))
		{
			$this->Flash->success(__('Token reset succesful'));
		}
		return $this->redirect($this->referer());
		$this->set(compact('user'));
	}
}
