<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	
		$this->loadModel('Settings');
		$config = $this->Settings->find('all')->first();
		//$system_name = $settings->get('system_name');
		$this->set('system_name', $config->get('system_name'));
		$this->set('system_abbr', $config->get('system_abbr'));
		$this->set('system_slogan', $config->get('system_slogan'));
		$this->set('organization_name', $config->get('organization_name'));
		$this->set('domain_name', $config->get('domain_name'));
		$this->set('email', $config->get('email'));
		$this->set('notification_email', $config->get('notification_email'));
		$this->set('meta_title', $config->get('meta_title'));
		$this->set('meta_keyword', $config->get('meta_keyword'));
		$this->set('meta_subject', $config->get('meta_subject'));
		$this->set('meta_copyright', $config->get('meta_copyright'));
		$this->set('meta_desc', $config->get('meta_desc'));
		$this->set('timezone', $config->get('timezone'));
		$this->set('author', $config->get('author'));
		$this->set('user_reg', $config->get('user_reg'));
		$this->set('hcaptcha_sitekey', $config->get('hcaptcha_sitekey'));
		$this->set('config_2', $config->get('config_2'));
		$this->set('config_3', $config->get('config_3'));
		$this->set('version', $config->get('version'));
		$this->set('notification', $config->get('notification'));
		$this->set('notification_status', $config->get('notification_status'));
		$this->set('ribbon_title', $config->get('ribbon_title'));
		$this->set('ribbon_link', $config->get('ribbon_link'));
		$this->set('ribbon_status', $config->get('ribbon_status'));
		$this->set('recrud', '1.0.3');
		//$this->set('telegram_bot_token', $config->get('telegram_bot_token'));
		//$this->set('telegram_chat_id', $config->get('telegram_chat_id'));
		
	}
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
}
