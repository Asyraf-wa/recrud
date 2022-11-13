<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;

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
		/* if(isset($this->request->query['search'])){
		  $this->request->query['search'] = explode(" ", $this->request->query['search']);
		} */
	}

    public function index()
    {
		$this->set('title', 'Contacts Management');
        $this->paginate = [
            //'contain' => ['Users'],
			'maxLimit' => 10,
        ];
        //$contacts = $this->paginate($this->Contacts);
		$contacts = $this->paginate($this->Contacts->find('search', ['search' => $this->request->getQuery()]));
		
		//count
		$this->set('total_contacts', $this->Contacts->find()->count());
		$this->set('total_contacts_pending', $this->Contacts->find()->where(['status' => 0])->count());
		$this->set('total_contacts_responded', $this->Contacts->find()->where(['status' => 1])->count());
		$this->set('total_contacts_ignored', $this->Contacts->find()->where(['status' => 2])->count());

//Count By Month
	$this->set('january', $this->Contacts->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('february', $this->Contacts->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('march', $this->Contacts->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('april', $this->Contacts->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may', $this->Contacts->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun', $this->Contacts->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('july', $this->Contacts->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('august', $this->Contacts->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('september', $this->Contacts->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('october', $this->Contacts->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('november', $this->Contacts->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('december', $this->Contacts->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        $this->set(compact('contacts'));
    }

    public function view($id = null)
    {
		$this->set('title', 'Contacts Details');
        $contact = $this->Contacts->get($id, [
            //'contain' => ['Users'],
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			$contact->respond_date_time = FrozenTime::now();
			$contact->status = 1;
			$contact->is_replied = true;
			$contact->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id');
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been replied.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('contact', 'users'));
    }

    public function edit($id = null)
    {
		$this->set('title', 'Contact Ticket Details');
        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			//$contact->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
			$contact->respond_date_time = FrozenTime::now();
			$contact->status = 1;
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('contact', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
