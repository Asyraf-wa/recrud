<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
//use Cake\Core\Configure;
use Cake\Utility\Hash;

class DashboardsController extends AppController
{
	public function index()
	{
		$this->set('title', 'Dashboard');
		

	}
}