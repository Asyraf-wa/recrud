<?php
declare(strict_types=1);

namespace App\Controller\Component;
//use Cake\ORM\TableRegistry;
//use Cake\Http\ServerRequest;
//use Cake\Controller\Component;
//use Cake\Controller\ComponentRegistry;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Http\ServerRequest;

/**
 * UserLogs component
 */
class UserLogsComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
	 
	use LocatorAwareTrait;
	
    protected $_defaultConfig = [];

	public function userLoginActivity($user_id)
    {
        $request = new ServerRequest;
        $userLogTable = $this->getTableLocator()->get('UserLogs');
        $userlog = $userLogTable->newEmptyEntity();
        $userlog->user_id = $user_id;
		$userlog->ip = $request->clientIp();
		$userlog->action = 'Login';
		$userlog->useragent = $_SERVER['HTTP_USER_AGENT'];
		$userlog->os = php_uname('v');
		$userlog->host = gethostname();
		$userLogTable->save($userlog);
    }
	
	public function userLogoutActivity($user_id)
    {
        $request = new ServerRequest;
        $userLogTable = $this->getTableLocator()->get('UserLogs');
        $userlog = $userLogTable->newEmptyEntity();
        $userlog->user_id = $user_id;
		$userlog->ip = $request->clientIp();
		$userlog->action = 'Logout';
		$userlog->useragent = $_SERVER['HTTP_USER_AGENT'];
		$userlog->os = php_uname('v');
		$userlog->host = gethostname();
		$userlog->referrer = $_SERVER['HTTP_REFERER'];
		$userLogTable->save($userlog);
    }
}
