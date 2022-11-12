<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\View\JsonView;
use Cake\View\XmlView;
/**
 * AuditLogs Controller
 *
 * @property \App\Model\Table\AuditLogsTable $AuditLogs
 * @method \App\Model\Entity\AuditLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuditLogsController extends AppController
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
	}

	public function viewClasses(): array
    {
        return [JsonView::class];
		//return [JsonView::class, XmlView::class];
    }
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('auditLogs', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'auditLogs');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('auditLogs.csv');
		$auditLogs = $this->AuditLogs->find();
		$_serialize = 'auditLogs';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('auditLogs', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$auditLogs = $this->paginate($this->AuditLogs);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'auditLogs_List.pdf' 
			]
		);
		$this->set(compact('auditLogs'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'AuditLogs List');
		$this->paginate = [
			//'maxLimit' => 10,
		];
		//Search
		$auditLogs = $this->paginate($this->AuditLogs->find('search', ['search' => $this->request->getQuery()]));
		
		//count
		$this->set('total_auditLogs', $this->AuditLogs->find()->count());
		$this->set('total_auditLogs_archived', $this->AuditLogs->find()->where(['status' => 2])->count());
		$this->set('total_auditLogs_active', $this->AuditLogs->find()->where(['status' => 1])->count());
		$this->set('total_auditLogs_disabled', $this->AuditLogs->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->AuditLogs->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->AuditLogs->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->AuditLogs->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->AuditLogs->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->AuditLogs->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->AuditLogs->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->AuditLogs->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->AuditLogs->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->AuditLogs->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->AuditLogs->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->AuditLogs->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->AuditLogs->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        $this->set(compact('auditLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Audit Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'AuditLogs Details');
        $auditLog = $this->AuditLogs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('auditLog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New AuditLogs');
        $auditLog = $this->AuditLogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $auditLog = $this->AuditLogs->patchEntity($auditLog, $this->request->getData());
            if ($this->AuditLogs->save($auditLog)) {
                $this->Flash->success(__('The audit log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The audit log could not be saved. Please, try again.'));
        }
        $this->set(compact('auditLog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Audit Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'AuditLogs Edit');
        $auditLog = $this->AuditLogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auditLog = $this->AuditLogs->patchEntity($auditLog, $this->request->getData());
            if ($this->AuditLogs->save($auditLog)) {
                $this->Flash->success(__('The audit log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The audit log could not be saved. Please, try again.'));
        }
        $this->set(compact('auditLog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Audit Log id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $auditLog = $this->AuditLogs->get($id);
        if ($this->AuditLogs->delete($auditLog)) {
            $this->Flash->success(__('The audit log has been deleted.'));
        } else {
            $this->Flash->error(__('The audit log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function change()
	{
		if($this->getRequest()->is('post')) {
			$check = $this->request->getData('check');
			$status = $this->request->getData('status');
			
			$this->AuditLogs->updateAll(
				['status ' => $status ],
				['id IN' => $check]
			);
			$this->Flash->success(__('The selected action has been succesfully executed'));
			return $this->redirect($this->referer());
		}
	}
}
