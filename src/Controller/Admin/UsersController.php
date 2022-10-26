<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

use Cake\View\JsonView;
use Cake\View\XmlView;

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

		$this->loadComponent('Search.Search', [
			'actions' => ['search'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		/* if(isset($this->request->query['search'])){
		  $this->request->query['search'] = explode(" ", $this->request->query['search']);
		} */
	}
	
	public function viewClasses(): array
    {
        return [JsonView::class];
		//return [JsonView::class, XmlView::class];
    }
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('users', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'users');
    }
	
	public function pdfProfile($slug = null)
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$user = $this->Users
			->findBySlug($slug)
			//->contain(['UserGroups', 'Contacts', 'UserLogs'])
			->firstOrFail();
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, // This can be omitted if "filename" is specified.
				'filename' => 'User_' . $slug . '.pdf' //// This can be omitted if you want file name based on URL.
			]
		);
		$this->set('user', $user);
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$this->paginate = [
            'contain' => ['UserGroups'],
			'maxLimit' => 10,
        ];
		$users = $this->paginate($this->Users);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'User_List.pdf' 
			]
		);
		$this->set(compact('users'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
		$this->set('title', 'User Details');
        /* $user = $this->Users->get($id, [
            'contain' => ['UserGroups', 'Contacts', 'UserLogs'],
        ]); */
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups', 'Contacts', 'UserLogs'])
			->firstOrFail();

        $this->set(compact('user'));
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('user.csv');
		$users = $this->Users->find();
		$_serialize = 'users';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('users', '_serialize'));
	}

	
	

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
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

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
