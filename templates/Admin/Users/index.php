<?php
	use Cake\Routing\Router;
	//echo $this->Html->css('select2/css/select2.css');
	//echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
	//$c_name = $this->request->getParam('controller');
	//echo $this->Html->script('bootstrapModal', ['block' => true]);
	echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
	$c_name = $this->request->getParam('controller');
?>
<div class="row mb-3">
	<div class="col-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-2">
<div class="text-end">
	<div class="dropdown mx-3">
		<button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fa-solid fa-bars text-primary"></i>
		</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
			<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Register New User'), ['action' => 'registration'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			<li><hr class="dropdown-divider"></li>
			<li><?= $this->Html->link(__('<i class="fa-solid fa-chart-line"></i> Report'), ['action' => 'report'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			<li><?= $this->Html->link(__('<i class="fa-solid fa-file-csv"></i> Export CSV'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
	</div>	
</div>
	</div>
</div>


		  


<div class="row">
	<div class="col-md-9">
<div class="nav-align-top mb-4">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-list" aria-controls="navs-top-list" aria-selected="true"><i class="fa-solid fa-bars-staggered"></i> List</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-report" aria-controls="navs-top-report" aria-selected="false"><i class="fa-solid fa-chart-line"></i> Report</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-export" aria-controls="navs-top-export" aria-selected="false"><i class="fa-solid fa-download"></i> Export</button>
        </li>
      </ul>
      <div class="tab-content px-0">
        <div class="tab-pane fade active show" id="navs-top-list" role="tabpanel">
<div class="table-responsive">
	<table class="table">
		<tr>
			<td>#</td>
			<td></td>
			<td><?= $this->Paginator->sort('user_group_id', 'Group') ?></td>
			<td><?= $this->Paginator->sort('fullname') ?></td>
			<td><?= $this->Paginator->sort('email') ?></td>
			<td class="text-center"><?= $this->Paginator->sort('status') ?></td>
			<td class="text-center"><?= __('Actions') ?></td>
		</tr>
		<?php
			$page = $this->Paginator->counter('{{page}}');
			$limit = 10; 
			$counter = ($page * $limit) - $limit + 1;
		?>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $counter++ ?></td>
			<td><?php if ($user->avatar != NULL) {
				echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['class'=> 'd-block rounded-circle shadow', 'width'=>'40px', 'height'=>'40px']);
				}else
				echo $this->Html->image('blank_profile.png', ['class'=> 'd-block rounded-circle shadow', 'width'=>'40px', 'height'=>'40px']);
				?>
			</td>
			<td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
			<td><?= h($user->fullname) ?></td>
			<td><?= h($user->email) ?></td>
			<td class="text-center">
			<?php if ($user->status == 1){
				echo '<span class="badge bg-success">Active</span>';
			}elseif ($user->status == 0){
				echo '<span class="badge bg-danger">Disabled</span>';
			}else
				echo '<span class="badge bg-secondary">Archived</span>';
			?>
			</td>
			<td class="actions text-center">
			

			
			
<div class="btn-group shadow" role="group" aria-label="Basic example">
<?php //echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $user->id], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) ?>
<?php echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'profile', $user->slug],['class'=> 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) ?>
<?php //echo $this->Form->postLink(__('<i class="fa-regular fa-trash-can"></i>'), ['action' => 'delete', $user->id],['class'=> 'btn btn-outline-danger btn-sm', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
<?php $this->Form->setTemplates([
	'confirmJs' => 'addToModal("{{formName}}"); return false;'
	//'confirmJs' => 'console.log("{{confirmMessage}} - {{formName}}"); return false;'
]); ?>

<?= $this->Form->postLink(
	__('<i class="fa-regular fa-trash-can"></i>'),
	['action' => 'delete', $user->id],
	[
		'confirm' => __('Are you sure you want to delete user: "{0}"?', $user->fullname),
		'title' => __('Delete'),
		'class' => 'btn btn-outline-danger btn-xs',
		'escapeTitle' => false,
		'data-bs-toggle' => "modal",
		'data-bs-target' => "#bootstrapModal"
	]
) ?>
</div>
				
				
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div aria-label="Page navigation" class="mt-3 px-2">
    <ul class="pagination justify-content-end">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} article(s) out of {{count}} total')) ?></div>
</div>

        </div>
        <div class="tab-pane fade px-4" id="navs-top-report" role="tabpanel">
		

<div class="row pb-3">
	<div class="col-md-4">
      <div class="stat_card card-1">
        <h3><?php echo $total_users; ?></h3>
        <p>Total Users</p>
      </div>
	</div>
	<div class="col-md-4">
      <div class="stat_card card-2">
        <h3><?php echo $total_users_active; ?></h3>
        <p>Active Users</p>
      </div>
	</div>
	<div class="col-md-4">
      <div class="stat_card card-3">
        <h3><?php echo $total_users_archived; ?></h3>
        <p>Archived Users</p>
      </div>
	</div>
</div>		
		
		
	

<hr/>




		
		


<div class="row">
	<div class="col-md-6">
<div class="chart-container" style="position: relative;">
    <canvas id="monthly_registered"></canvas>
</div>
<script>
const ctx = document.getElementById('monthly_registered');
const monthly_registered = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# of User(s)',
			data: [<?= json_encode($january); ?>, <?= json_encode($february); ?>, <?= json_encode($march); ?>, <?= json_encode($april); ?>, <?= json_encode($may); ?>, <?= json_encode($jun); ?>, <?= json_encode($july); ?>, <?= json_encode($august); ?>, <?= json_encode($september); ?>, <?= json_encode($october); ?>, <?= json_encode($november); ?>, <?= json_encode($december); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(89, 233, 28, 0.2)',
				'rgba(255, 5, 5, 0.2)',
                'rgba(255, 128, 0, 0.2)',
                'rgba(153, 153, 153, 0.2)',
                'rgba(15, 207, 210, 0.2)',
                'rgba(44, 13, 181, 0.2)',
                'rgba(86, 172, 12, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(89, 233, 28, 1)',
				'rgba(255, 5, 5, 1)',
                'rgba(255, 128, 0, 1)',
                'rgba(153, 153, 153, 1)',
                'rgba(15, 207, 210, 1)',
                'rgba(44, 13, 181, 1)',
                'rgba(86, 172, 12, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
		plugins: {
            title: {
                display: true,
                text: 'User Registered (Monthly)',
				font: {
				  size: 15
					}
				},
			subtitle: {
                display: true,
                text: '<?php echo $system_name; ?>'
				},
			legend: {
					display: false,
					labels: {
						color: 'rgb(255, 99, 132)'
					}
				},
        }
    }
});
</script>
	</div>
	<div class="col-md-6">
<div class="chart-container" style="position: relative;">
    <canvas id="status"></canvas>
</div>
<script>
const ctx_2 = document.getElementById('status');
const status = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: ['Active', 'Disabled', 'Archived'],
        datasets: [{
            label: '# of User(s)',
			data: [<?= json_encode($total_users_active); ?>, <?= json_encode($total_users_disabled); ?>, <?= json_encode($total_users_archived); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
		plugins: {
            title: {
                display: true,
                text: 'User by Status',
				font: {
				  size: 15
					}
				},
			subtitle: {
                display: true,
                text: '<?php echo $system_name; ?>'
				},
			legend: {
					display: false,
					labels: {
						color: 'rgb(255, 99, 132)'
					}
				},
        }
    }
});
</script>
	</div>
</div>
		

        </div>
        <div class="tab-pane fade px-4" id="navs-top-export" role="tabpanel">
<?php
	$domain = Router::url("/", true);
	$sub = 'admin/users';
	$combine = $domain . $sub;
?>
<div class="row pb-3">
	<div class="col-md-3 mb-2">
	<a href='<?php echo $combine; ?>/csv' class="kosong">
		<div class="card border shadow">
			<div class="row mx-0">
				<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-file-csv fa-2x text-primary" style=""></i></div>
				<div class="col-7 text-end m-auto">
					<div class="fs-4 fw-bold">CSV</div>
					<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
				</div>
			</div>
		</div>
	</a>
	</div>
	<div class="col-md-3 mb-2">
		<a href='<?php echo $combine; ?>/xml' class="kosong">
		<div class="card border shadow">
			<div class="row mx-0">
				<div class="col-5 text-center mt-3 mb-3"><i class="fa-brands fa-buromobelexperte fa-2x text-success" style=""></i></div>
				<div class="col-7 text-end m-auto">
					<div class="fs-4 fw-bold">XML</div>
					<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	<div class="col-md-3 mb-2">
		<a href='<?php echo $combine; ?>/json' class="kosong" target="_blank">
		<div class="card border shadow">
			<div class="row mx-0">
				<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-braille fa-2x text-warning" style=""></i></div>
				<div class="col-7 text-end m-auto">
					<div class="fs-4 fw-bold">JSON</div>
					<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
				</div>
			</div>
		</div>
		</a>
	</div>
	<div class="col-md-3 mb-2">
		<a href='<?php echo $combine; ?>/pdfList' class="kosong">
		<div class="card border shadow">
			<div class="row mx-0">
				<div class="col-5 text-center mt-3 mb-3"><i class="fa-regular fa-file-pdf fa-2x text-danger" style=""></i></div>
				<div class="col-7 text-end m-auto">
					<div class="fs-4 fw-bold">PDF</div>
					<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
				</div>
			</div>
		</div>
		</a>
	</div>
</div>	
        </div>
      </div>
</div>
	</div>
	<div class="col-md-3">

<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #1da1f2;color: #ffffff;">
	  <i class="fa-solid fa-magnifying-glass fa-xl" style="margin-left: 12px;margin-top: 22px;"></i>
    </div>
		<div class="card-body small-text pt-0">
			<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'users','action' => 'index']]); ?>
			<fieldset>
			<div class="mb-1"><?php echo $this->Form->control('fullname',['required' => false]); ?></div>
			<div class="mb-1"><?php echo $this->Form->control('email',['required' => false]); ?></div>
				<?php //echo $this->Form->control('fullname',['class' => 'form-control form-control-sm','required' => false]); ?>
				<?php //echo $this->Form->control('email',['class' => 'form-control form-control-sm','required' => false]); ?>
				
<div class="mb-3">
    <?php echo $this->Form->label('User Group/Role'); ?><br>
    <?php
    $options = [
        '1' => 'Admin',
        '2' => 'Mod',
        '3' => 'User',
    ];
    echo $this->Form->select('user_group_id', $options, [
        'multiple' => 'checkbox',
        'class' =>'form-check-input'
    ]); 
    ?>
</div>

<div class="mb-1">
    <?php echo $this->Form->label('Status'); ?><br>
    <?php
    $options = [
        '1' => 'Active',
        '0' => 'Disabled',
        '2' => 'Archived',
    ];
    echo $this->Form->select('status', $options, [
        'multiple' => 'checkbox',
        'class' =>'form-check-input'
    ]); 
    ?>
</div>

<div class="row">
	<div class="col-6">
	<?php echo $this->Form->control('register_from',[
				  'class' => 'form-control form-control-sm datepicker-here', 
				  'label' => 'Register From',
				  'id' => 'register_from',
				  'type' => 'Text',
				  'data-language' => 'en',
				  'data-date-format' => 'Y-m-d',
				  'empty'=>'empty',
				  'required' => false,
				  'autocomplete' => 'off'
	]); ?>
	</div>
	<div class="col-6">
	<?php echo $this->Form->control('register_to',[
				  'class' => 'form-control form-control-sm datepicker-here', 
				  'label' => 'Register To',
				  'id' => 'register_to',
				  'type' => 'Text',
				  'data-language' => 'en',
				  'data-date-format' => 'Y-m-d',
				  'empty'=>'empty',
				  'required' => false,
				  'autocomplete' => 'off'
	]); ?>
	</div>
</div>

<?php //echo $this->Form->checkbox('is_email_verified'); ?>
<?php echo $this->Form->control('is_email_verified', [
	'options'=> [
		'1' => 'Verified',
		'0' => 'Not Verified',
	], 
	'label'=>'Email Verified', 
	//'value'=>'Verified',
	'empty' => '(Select status)',
	'class' => 'form-select'
	]); ?>

			</fieldset>
				<div class="text-end">
<?php 
	if (!empty($_isSearch)) {
		echo ' ';
		echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-warning btn-sm']);
	}
	echo '&nbsp;&nbsp;';
	echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-primary btn-sm']);
?>
				  <?= $this->Form->end() ?>
                </div>
		</div>
  </div>
</div>

	</div>
</div>



<script type="text/javascript">
$('#register_from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});

$('#register_to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>



<div class="modal" id="bootstrapModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
			<i class="fa-regular fa-circle-xmark fa-6x text-danger mb-3"></i>
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="ok">OK</button>
            </div>
        </div>
    </div>
</div>



