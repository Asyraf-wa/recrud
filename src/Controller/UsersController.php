<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;

use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;

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

		$this->Authentication->allowUnauthenticated(['login','registration','forgotPassword','forgotUsername','resetPassword','verify']);
	}
	
	public function login()
	{
		$this->set('title', 'Sign-in');
		$result = $this->Authentication->getResult();
		if ($result->isValid()) {
			$target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
			$this->UserLogs->userLoginActivity($this->Authentication->getIdentity('id')->getIdentifier('id'));
			return $this->redirect($target);
		}
		if ($this->request->is('post')) {
			$this->Flash->error('Invalid username or password');
		}
	}
	
	public function logout()
	{
		$this->UserLogs->userLogoutActivity($this->Authentication->getIdentity('id')->getIdentifier('id'));
		$this->Authentication->logout();
		return $this->redirect(['controller' => 'Users', 'action' => 'login']);
	}
	
	public function forgotUsername()
	{
		$this->set('title', 'Forgot Username');
		if ($this->request->is('post')) {
				$email = $this->request->getData('email');
				$userTable = TableRegistry::get('Users');
				
					if ($email == NULL) {
						$this->Flash->error(__('Please insert your email address')); 
					} 
					if	($user = $userTable->find('all')->where(['email'=>$email])->first()) { 
						 $fullname = $user->fullname;
						if ($userTable->save($user)){
							$mailer = new Mailer('default');
							$mailer->setTransport('smtp');
							$mailer->setFrom(['noreply@codethepixel.com' => 'ReCRUD'])
							->setTo($email)
							->setEmailFormat('html')
							->setSubject('Forgot Username Request')
							->deliver('Hi<br/><br/>Your username is '.$fullname.'</a>');
						}
						$this->Flash->success('Your username is sent to '.$email.', please check your email');
					}
					if	($total = $userTable->find('all')->where(['email'=>$email])->count()==0) {
						$this->Flash->error(__('Email is not registered in system'));
					}
			}
	}
	
	public function forgotPassword()
	{
		$this->set('title', 'Forgot Password');
	if ($this->request->is('post')) {
			$email = $this->request->getData('email');
			$token = Security::hash(Security::randomBytes(25));
			
			$userTable = TableRegistry::get('Users');
				if ($email == NULL) {
					$this->Flash->error(__('Please insert your email address')); 
				} 
				if	($user = $userTable->find('all')->where(['email'=>$email])->first()) { 
					$user->token = $token;
					if ($userTable->save($user)){
						$mailer = new Mailer('default');
						$mailer->setTransport('smtp');
						$mailer->setFrom(['noreply@codethepixel.com' => 'ReCRUD'])
						->setTo($email)
						->setEmailFormat('html')
						->setSubject('Forgot Password Request')
						->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="http://localhost/recrud/users/reset_password/'.$token.'">Reset Password</a>');
					}
					$this->Flash->success('Reset password link has been sent to your email ('.$email.'), please check your email');
				}
				if	($total = $userTable->find('all')->where(['email'=>$email])->count()==0) {
					$this->Flash->error(__('Email is not registered in system'));
				}
		}
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
}
