<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

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

?>

<h1 class="m-0 me-2 page_title">Re-CRUD Documentation</h1>
<small class="text-muted"><?php echo $system_name; ?></small>

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
	<div class="col-md-3">
		<div class="card shadow">
			<div class="card-body">

INITIAL CONFIGURATION
<ul>
<li><?php echo $this->Html->link('Basic Requirements','#a1',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Clone Repository','#a2',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Database Configuration','#a3',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Database Migration','#a4',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Database Data Seeding','#a5',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Email Configuration','#a6',['class' => '']); ?></li>
</ul>


CRUD OPERATION
<ul>
<li><?php echo $this->Html->link('Change Directory','#b1',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Generate CRUD','#b2',['class' => '']); ?></li>
</ul>

AUTHENTICATION &amp; AUTHORIZATION
<ul>
<li><?php echo $this->Html->link('Default Auth Information','#c1',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Allow Unauthorized Page','#c2',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Print Auth Info','#c3',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Conditional Checking','#c4',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Capture User ID','#c5',['class' => '']); ?></li>
</ul>

SEARCH
<ul>
<li><?php echo $this->Html->link('Search Manager','#d1',['class' => '']); ?></li>
</ul>

FORM AND OTHERS
<ul>
<li><?php echo $this->Html->link('Button Style','#e1',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Card','#e2',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Link','#e3',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Image','#e4',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Date Time Format','#e5',['class' => '']); ?></li>
</ul>

PDF Related
<ul>
<li><?php echo $this->Html->link('PDF Controller','#f1',['class' => '']); ?></li>
<li><?php echo $this->Html->link('PDF FileName','#f2',['class' => '']); ?></li>
<li><?php echo $this->Html->link('PDF Template','#f3',['class' => '']); ?></li>
<li><?php echo $this->Html->link('PDF Download Link','#f4',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Image in PDF','#f5',['class' => '']); ?></li>
<li><?php echo $this->Html->link('External CSS in PDF','#f6',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Save PDF to Server','#f7',['class' => '']); ?></li>
<li><?php echo $this->Html->link('Email Saved PDF as Email Attachment','#f8',['class' => '']); ?></li>
</ul>
			</div>
		</div>

	</div>
	<div class="col-md-9">
<div class="card shadow">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Initial Configuration</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">
<div class="fw-bold fs-5" id="a1">Basic Requirements</div>
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

<br/>
<div class="fw-bold fs-5" id="a2">Clone Repository</div>
<div class="fw-light" id="a2">
Clone Re-CRUD using composer:<br/>
<pre class="bg-light-gray">composer create-project recrud/recrud</pre>
or
<br/>
Clone Re-CRUD using git:<br/>
<pre class="bg-light-gray">git clone https://github.com/Asyraf-wa/recrud.git</pre>
</div>
<br/>
<div class="fw-bold fs-5" id="a3">Database</div>
<div class="fw-light" id="a3">
Rename file <kbd>app_local_example.php</kbd> to <kbd>app_local.php</kbd> in config folder
<br/>
Create database in <kbd>phpmyadmin</kbd>
<br/>
Configure database:
<br/>
<pre class="bg-light-gray">
'Datasources' => [
	'default' => [
		'host' => 'localhost',
		//'port' => 'non_standard_port_number',
		'username' => 'root',
		'password' => '',
		'database' => 'recrud',
		'url' => env('DATABASE_URL', null),
	],
]
</pre>
</div>
<br/>
<div class="fw-bold fs-5" id="a4">Database Migration</div>
<div class="fw-light" id="a4">
Database migration
<pre class="bg-light-gray">bin/cake migrations migrate</pre>
</div>
<br/>
<div class="fw-bold fs-5" id="a5">Database Seeding</div>
<div class="fw-light" id="a5">
Database seeding
<pre class="bg-light-gray">bin/cake migrations seed</pre>
</div>
<br/>
<div class="fw-bold fs-5" id="a6">Email Configuration</div>
<div class="fw-light" id="a6">
open <kbd>app_local.php</kbd> and add the following SMTP email configuration:
<pre class="bg-light-gray">
'EmailTransport' => [
	'smtp' => [
		'host' => 'YourHost',
		'port' => 25,
		'username' => 'emailUsername',
		'password' => 'emailPassword',
		'className' => 'Smtp',
		'client' => null,
		'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
	],
],
</pre>
</div>
	</div>
</div>	


<div class="card shadow mt-4">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">CRUD Operation</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">
<div class="fw-bold fs-5" id="b1">Change Directory</div>
<div class="fw-light" id="b1">
Change to the target directory. Depend on your webserver directory. This is the example of XAMPP directory installed in drive C, Windows environment:
<pre class="bg-light-gray">cd c:/xampp/htdocs</pre>
If using WAMP 64bit, installed in drive C, windows environment, the directory is:
<pre class="bg-light-gray">cd c:/wamp64/htdocs</pre>
To create CRUD, the directory should target the bin folder in the root directory eg:<br/>
<em>Note: You can rename the recrud folder according to your system abbreviation.</em>
<pre class="bg-light-gray">cd c:/wamp64/htdocs/recrud/bin</pre>
</div>

<div class="fw-bold fs-5" id="b2">Generate CRUD</div>
<div class="fw-light" id="b2">
Run the following command to generate the CRUD
<pre class="bg-light-gray">cake bake all tableName</pre>
</div>
	</div>
</div>



<div class="card shadow mt-4">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Authentication &amp; Authorization</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">
<div class="fw-bold fs-5" id="c1">Default Authentication Information</div>
<div class="fw-light" id="c1">
Default authentication information / user account:
Email: <kbd>recrud@recrud.com</kbd> Password: <kbd>123456</kbd>
</div>

<br/>
<div class="fw-bold fs-5" id="c2">Allow Unauthorized Page</div>
<div class="fw-light" id="c2">
By default, the authentication plugin will block all pages. To allow unauthenticated page, insert the following code in the controller:
<pre class="bg-light-gray">
public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    $this->Authentication->addUnauthenticatedActions(['login','add']);
}
</pre>
</div>

<div class="fw-bold fs-5" id="c3">Print Auth Info</div>
<div class="fw-light" id="c3">
To print the current authenticated information eg, fullname, use the following code:
<pre class="bg-light-gray">echo $this->Identity->get('username');</pre>
</div>

<div class="fw-bold fs-5" id="c4">Conditional Checking</div>
<div class="fw-light" id="c4">
Simple conditional checking:
<pre class="bg-light-gray">
if ($this->Identity->isLoggedIn()) {
	echo 'User Logged in';
}
</pre>
</div>

<div class="fw-bold fs-5" id="c5">Capture User ID</div>
<div class="fw-light" id="c5">
To capture currently authenticated user ID in the controller, simply use the following code before save in the controller:
<pre class="bg-light-gray">$article->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id');</pre>
</div>
	</div>
</div>


<div class="card shadow mt-4">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Search</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">

<div class="fw-bold fs-5" id="d1">Search Manager</div>
<div class="fw-light" id="d1">
File Location: ...\src\Model\Table\YoursTable.php<br/>
If you need need to search more fields, add more attributes in the fields array. 
<pre class="bg-light-gray">
public function initialize(array $config): void
{
	parent::initialize($config);

	//other codes
	
	$this->addBehavior('Search.Search');

	$this->searchManager()
		->value('role')
		->add('search', 'Search.Like', [ 
			'before' => true,
			'after' => true,
			'fieldMode' => 'OR',
			'comparison' => 'LIKE',
			'wildcardAny' => '*',
			'wildcardOne' => '?',
			'fields' => ['name','email','role'],
		]);
}
</pre>
</div>
	</div>
</div>



<div class="card shadow mt-4">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">Form and Others</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">

<div class="fw-bold fs-5" id="e1">Button Style</div>
<div class="fw-light" id="e1">
Button with outline primary style
<pre class="bg-light-gray">
$this->Html->link(__('<i class="fa-solid fa-plus"></i> Register'), ['action' => 'add'], ['class' => 'btn btn-sm btn-outline-primary', 'escapeTitle' => false])
</pre>
</div>

<div class="fw-bold fs-5" id="e2">Card</div>
<div class="fw-light" id="e2">
Example of default card used in this project
<pre class="bg-light-gray">
< div class="card shadow">
	< div class="card-body">

	< /div>
< /div >
</pre>
</div>

<div class="fw-bold fs-5" id="e3">Link</div>
<div class="fw-light" id="e3">
External Link:
<pre class="bg-light-gray">
echo $this->Html->link('Enter','/pages/home', ['class' => 'button', 'target' => '_blank']);
</pre>
Internal Link:
<pre class="bg-light-gray">
$this->Html->link(__('<i class="fa-solid fa-plus"></i> Register'), ['action' => 'add'], ['class' => '', 'escapeTitle' => false])
</pre>
</div>

<div class="fw-bold fs-5" id="e4">Image</div>
<div class="fw-light" id="e4">
Put your image in .../webroot/img and load the following script:
<pre class="bg-light-gray">echo $this->Html->image('logo.png', ['alt' => 'ReCRUD']);</pre>
</div>

<div class="fw-bold fs-5" id="e5">Date Time Format</div>
<div class="fw-light" id="e5">
Sample code for rendering the date and time into readable format.
<pre class="bg-light-gray">echo date('M d, Y (h:i A)', strtotime($user->created));</pre>
</div>
	</div>
</div>


<div class="card shadow mt-4">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title">PDF Related</h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
	</div>
	<div class="card-body mt-4">

<div class="fw-bold fs-5" id="f1">PDF Controller</div>
<div class="fw-light" id="f1">
PDf controller used to generate the PDF:
	<pre class="bg-light-gray">
public function pdf($id = null)
{
    $this->viewBuilder()->enableAutoLayout(false); 
    $report = $this->Reports->get($id);
    $this->viewBuilder()->setClassName('CakePdf.Pdf');
    $this->viewBuilder()->setOption(
        'pdfConfig',
        [
            'orientation' => 'portrait',
            'download' => true, // This can be omitted if "filename" is specified.
            'filename' => 'Report_' . $id . '.pdf' //// This can be omitted if you want file name based on URL.
        ]
    );
    $this->set('report', $report);
}
	</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f2">
	<pre class="bg-light-gray">

	</pre>
</div>


<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f3">
File Location: ...\src\Model\Table\YoursTable.php<br/>
If you need need to search more fields, add more attributes in the fields array. 
<pre class="bg-light-gray">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
&lt;title&gt;PDF&lt;/title&gt;
&lt;style&gt;
@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}
&lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
	Content
&lt;/body&gt;
&lt;/html&gt;
</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f4">
	<pre class="bg-light-gray">

	</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f5">
	<pre class="bg-light-gray">

	</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f6">
	<pre class="bg-light-gray">

	</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f7">
	<pre class="bg-light-gray">

	</pre>
</div>

<div class="fw-bold fs-5" id="f1">PDF</div>
<div class="fw-light" id="f8">
	<pre class="bg-light-gray">

	</pre>
</div>

	</div>
</div>
	

	</div>
</div>



