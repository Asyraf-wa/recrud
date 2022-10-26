<?php
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
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

//$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<style>
.resp-container {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%;
}

.resp-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
</style>

	<div class="row">
		<div class="col-md-9">
			<div class="card shadow">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Re-CRUD</h1>
		  <small class="text-muted">Code The Pixel</small>
		</div>
	</div>
				<div class="card-body">
<?php Debugger::checkSecurityKeys(); ?>
<div class="row">
  <div class="col">
  Environment:<br>
  <ul class="fa-ul">
	<?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP is 7.2.0 or higher (detected <?php echo PHP_VERSION ?>).</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP is too low. You need PHP 7.2.0 or higher to use CakePHP (detected <?php echo PHP_VERSION ?>).</li>
	<?php endif; ?>

	<?php if (extension_loaded('mbstring')) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the mbstring extension loaded.</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the mbstring extension loaded.</li>
	<?php endif; ?>

	<?php if (extension_loaded('openssl')) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the openssl extension loaded.</li>
	<?php elseif (extension_loaded('mcrypt')) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the mcrypt extension loaded.</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
	<?php endif; ?>

	<?php if (extension_loaded('intl')) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your version of PHP has the intl extension loaded.</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your version of PHP does NOT have the intl extension loaded.</li>
	<?php endif; ?>
  </ul>
  </div>
  <div class="col">
  Filesystem:<br>
	<ul class="fa-ul">
	<?php if (is_writable(TMP)) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your tmp directory is writable.</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your tmp directory is NOT writable.</li>
	<?php endif; ?>

	<?php if (is_writable(LOGS)) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Your logs directory is writable.</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your logs directory is NOT writable.</li>
	<?php endif; ?>

	<?php $settings = Cache::getConfig('_cake_core_'); ?>
	<?php if (!empty($settings)) : ?>
		<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> The <em><?php echo $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
	<?php else : ?>
		<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Your cache is NOT working. Please check the settings in config/app.php</li>
	<?php endif; ?>
	</ul>
  </div>
</div>

<hr>

<div class="row">
  <div class="col">
  Database:<br>
		<?php
		try {
			$connection = ConnectionManager::get('default');
			$connected = $connection->connect();
		} catch (Exception $connectionError) {
			$connected = false;
			$errorMsg = $connectionError->getMessage();
			if (method_exists($connectionError, 'getAttributes')) :
				$attributes = $connectionError->getAttributes();
				if (isset($errorMsg['message'])) :
					$errorMsg .= '<br />' . $attributes['message'];
				endif;
			endif;
		}
		?>
		<ul class="fa-ul">
		<?php if ($connected) : ?>
			<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> Re-CRUD is able to connect to the database.</li>
		<?php else : ?>
			<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> Re-CRUD is NOT able to connect to the database.<br /><?php echo $errorMsg ?></li>
		<?php endif; ?>
		</ul>
  </div>
  <div class="col">
  Debugkit:<br>
		<ul class="fa-ul">
		<?php if (Plugin::isLoaded('DebugKit')) : ?>
			<li><span class="fa-li"><i class="fas fa-check text-success"></i></span> DebugKit is loaded.</li>
		<?php else : ?>
			<li><span class="fa-li"><i class="fas fa-times text-danger"></i></span> DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
		<?php endif; ?>
		</ul>
  </div>
</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card shadow">
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>
