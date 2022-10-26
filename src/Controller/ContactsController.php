<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
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
		$this->Authentication->allowUnauthenticated(['add','check']);
		/* if(isset($this->request->query['search'])){
		  $this->request->query['search'] = explode(" ", $this->request->query['search']);
		} */
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $contacts = $this->paginate($this->Contacts);

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('contact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'Contact');
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('contact', 'users'));
    }
	
	public function check()
	{
		$this->set('title', 'Contact Ticket Response Check');
		//$this->paginate['maxLimit'] = 999;
        $this->paginate = [
            'contain' => '',
        ];

        //$contacts = $this->paginate($this->Contacts);

		
		$contacts = $this->paginate($this->Contacts->find('search', ['search' => $this->request->getQuery()]));
	
		$ticket = $this->request->getQuery('ticket');
		
		if ($ticket != NULL) {
			$this->set('count_ticket', $this->Contacts->find()->where(['ticket' => $ticket])->count());
		} elseif ($ticket == null) {
			$this->set('count_ticket', '0');
		} else
			$this->set('count_ticket', '2');
		
		$this->set(compact('contacts'));
		$this->set('_serialize', ['contacts']);
	}
}
