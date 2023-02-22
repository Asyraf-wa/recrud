<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\View\JsonView;
use Cake\View\XmlView;
use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;
/**
 * Playgrounds Controller
 *
 * @property \App\Model\Table\PlaygroundsTable $Playgrounds
 * @method \App\Model\Entity\Playground[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlaygroundsController extends AppController
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
        $this->set('playgrounds', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'playgrounds');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('playgrounds.csv');
		$playgrounds = $this->Playgrounds->find();
		$_serialize = 'playgrounds';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('playgrounds', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$playgrounds = $this->paginate($this->Playgrounds);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'playgrounds_List.pdf' 
			]
		);
		$this->set(compact('playgrounds'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
		$this->set('title', 'Playgrounds List');
		$this->paginate = [
			'maxLimit' => 10,
		];
		//Search
		$playgrounds = $this->paginate($this->Playgrounds->find('search', ['search' => $this->request->getQuery()]));
		
		//count
		$this->set('total_playgrounds', $this->Playgrounds->find()->count());
		$this->set('total_playgrounds_archived', $this->Playgrounds->find()->where(['status' => 2])->count());
		$this->set('total_playgrounds_active', $this->Playgrounds->find()->where(['status' => 1])->count());
		$this->set('total_playgrounds_disabled', $this->Playgrounds->find()->where(['status' => 0])->count());
		
		//Count By Month
		$this->set('january', $this->Playgrounds->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->Playgrounds->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->Playgrounds->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->Playgrounds->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->Playgrounds->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->Playgrounds->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->Playgrounds->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->Playgrounds->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->Playgrounds->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->Playgrounds->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->Playgrounds->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->Playgrounds->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        $this->set(compact('playgrounds'));
    }

    /**
     * View method
     *
     * @param string|null $id Playground id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Playgrounds Details');
        $playground = $this->Playgrounds->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('playground'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Playgrounds');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Playgrounds']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $playground = $this->Playgrounds->newEmptyEntity();
        if ($this->request->is('post')) {
            $playground = $this->Playgrounds->patchEntity($playground, $this->request->getData());
            if ($this->Playgrounds->save($playground)) {
                $this->Flash->success(__('The playground has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playground could not be saved. Please, try again.'));
        }
        $this->set(compact('playground'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Playground id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Playgrounds Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Playgrounds']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $playground = $this->Playgrounds->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $playground = $this->Playgrounds->patchEntity($playground, $this->request->getData());
            if ($this->Playgrounds->save($playground)) {
                $this->Flash->success(__('The playground has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playground could not be saved. Please, try again.'));
        }
        $this->set(compact('playground'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Playground id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Playgrounds']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $playground = $this->Playgrounds->get($id);
        if ($this->Playgrounds->delete($playground)) {
            $this->Flash->success(__('The playground has been deleted.'));
        } else {
            $this->Flash->error(__('The playground could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Playgrounds Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Playgrounds']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $playground = $this->Playgrounds->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $playground = $this->Playgrounds->patchEntity($playground, $this->request->getData());
			$playground->status = 2; //archived
            if ($this->Playgrounds->save($playground)) {
                $this->Flash->success(__('The playground has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The playground could not be archived. Please, try again.'));
        }
        $this->set(compact('playground'));
    }
}
