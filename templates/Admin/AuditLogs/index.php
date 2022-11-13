<?php
	use Cake\Routing\Router;
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
	$c_name = $this->request->getParam('controller');
	echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row mb-3">
	<div class="col-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-2">
		<div class="text-end">
	
		</div>
	</div>
</div>
<?= $this->Form->create(null,['url'=>['action'=>'change']]) ?>
<!--Column-->
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
		
<div class="px-3 pb-3 text-end">
<i class="fa-solid fa-circle text-success"></i> Active | <i class="fa-solid fa-circle text-secondary"></i> Archived
</div>		
		
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th><?= $this->Form->checkbox('check[]',['onchange'=>'checkAll(this)', 'name'=>'chk[]']) ?></th>	
				<th>#</th>
				<th><?= $this->Paginator->sort('id','Log_id') ?></th>
				<th><?= $this->Paginator->sort('type','Activity') ?></th>
				<th><?= $this->Paginator->sort('primary_key','PK') ?></th>
				<th><?= $this->Paginator->sort('source') ?></th>
				<th><?= $this->Paginator->sort('created','Logged on') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('status') ?></th>
				<th class="text-center"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<?php
			$page = $this->Paginator->counter('{{page}}');
			$limit = 10; 
			$counter = ($page * $limit) - $limit + 1;
		?>
		
		<?php foreach ($auditLogs as $auditLog): ?>
		<tr>
			<td><?php echo $this->Form->checkbox('check[]',['value'=>$auditLog->id]) ?></td>
			<td><?php echo $counter++ ?></td>
                    <td><?= $this->Number->format($auditLog->id) ?></td>
                    <td>
<?php 
if ($auditLog->type == 'create'){
echo '<span class="badge bg-success">Create</span>';
} elseif ($auditLog->type == 'update'){
echo '<span class="badge bg-warning">Update</span>';
} elseif ($auditLog->type == 'delete'){
echo '<span class="badge bg-danger">Delete</span>'; 
} elseif ($auditLog->type == 'archived'){
echo '<span class="badge bg-danger">Archived</span>'; 
}else
echo ($auditLog->type);
?>
					</td>
                    <td><?= $auditLog->primary_key === null ? '' : $this->Number->format($auditLog->primary_key) ?></td>
                    <td><?= h($auditLog->source) ?></td>
                    <td><?php echo date('M d, Y (h:i A)', strtotime($auditLog->created)); ?></td>
					<td class="text-center">
					<?php if($auditLog->status == 1	){
						echo '<i class="fa-solid fa-circle text-success"></i>';
					}else
						echo '<i class="fa-solid fa-circle text-archived"></i>';
					?>
					
					</td>
			<td class="actions text-center">
	<div class="btn-group shadow" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $auditLog->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
	</div>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="row px-3">
	<div class="col-md-2 col-5 pe-0">
			<?php echo $this->Form->control('status', [
				'class' => 'form-select form-select-sm',
				'required' => false,
				'options' => [
					'1' => 'Active', 
					'2' => 'Archived',
					], 
				'empty' => 'Update Status',
				'label' => false]); ?>
	</div>
	<div class="col-md-8 col-3 ps-1">
		<div class="text-start">
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-success btn-flat btn-sm']) ?>
		</div>
	</div>
	<div class="col-md-2 col-4">
		<div class="text-end">
<?php echo $this->Paginator->limitControl([10 => 'Show 10 entries',25 => 'Show 25 entries', 50 => 'Show 50 entries', 100 => 'Show 100 entries'], $auditLog->perPage,['class' => 'form-select form-select-sm','label' => false]); ?>
		</div>
	</div>
</div>

<div aria-label="Page navigation" class="mt-3 px-2">
    <ul class="pagination justify-content-end flex-wrap">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
</div>

        </div>
        <div class="tab-pane fade px-4" id="navs-top-report" role="tabpanel">
		

<div class="row pb-3">
	<div class="col-md-4">
      <div class="stat_card card-1">
        <h3><?php echo $total_auditLogs; ?></h3>
        <p>Total Audit Logs</p>
      </div>
	</div>
	<div class="col-md-4">
      <div class="stat_card card-2">
        <h3><?php echo $total_auditLogs_active; ?></h3>
        <p>Active Audit Logs</p>
      </div>
	</div>
	<div class="col-md-4">
      <div class="stat_card card-3">
        <h3><?php echo $total_auditLogs_archived; ?></h3>
        <p>Archived Audit Logs</p>
      </div>
	</div>
</div>		
		
		
	

<hr/>




		
		


<div class="row">
	<div class="col-md-6">
<div class="chart-container" style="position: relative;">
    <canvas id="monthly"></canvas>
</div>
<script>
const ctx = document.getElementById('monthly');
const monthly = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# of Audit Logs(s)',
			data: [<?= json_encode($january); ?>, <?= json_encode($february); ?>, <?= json_encode($march); ?>, <?= json_encode($april); ?>, <?= json_encode($may); ?>, <?= json_encode($jun); ?>, <?= json_encode($july); ?>, <?= json_encode($august); ?>, <?= json_encode($september); ?>, <?= json_encode($october); ?>, <?= json_encode($november); ?>, <?= json_encode($december); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(89, 233, 28, 0.2)','rgba(255, 5, 5, 0.2)','rgba(255, 128, 0, 0.2)','rgba(153, 153, 153, 0.2)','rgba(15, 207, 210, 0.2)','rgba(44, 13, 181, 0.2)','rgba(86, 172, 12, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(89, 233, 28, 1)','rgba(255, 5, 5, 1)','rgba(255, 128, 0, 1)','rgba(153, 153, 153, 1)','rgba(15, 207, 210, 1)','rgba(44, 13, 181, 1)','rgba(86, 172, 12, 1)'
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
                text: 'Audit Logs (Monthly)',
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
    <canvas id="status_chart"></canvas>
</div>
<script>
const ctx_2 = document.getElementById('status_chart');
const status_chart = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: ['Active', 'Disabled', 'Archived'],
        datasets: [{
            label: '# of Audit Logs(s)',
			data: [<?= json_encode($total_auditLogs_active); ?>, <?= json_encode($total_auditLogs_disabled); ?>, <?= json_encode($total_auditLogs_archived); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)',
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
                text: 'Audit Logs by Status',
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
	$sub = 'admin/auditLogs';
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
			<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Audit Logs','action' => 'index']]); ?>
			<fieldset>
			<div class="mb-1"><?php echo $this->Form->control('id',['label' => 'Log ID', 'required' => false]); ?></div>
			<div class="mb-1"><?php echo $this->Form->control('primary_key',['label' => 'Primary Key', 'required' => false]); ?></div>
			<div class="mb-1"><?php echo $this->Form->control('source',['label' => 'Source', 'required' => false]); ?></div>
			<div class="mb-1">
				<?php echo $this->Form->label('Activity'); ?><br>
				<?php
				$options = [
					'create' => 'Create',
					'Update' => 'Update',
					'delete' => 'Delete',
				];
				echo $this->Form->select('type', $options, [
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
					'2' => 'Archived'
				];
				echo $this->Form->select('status', $options, [
					'multiple' => 'checkbox',
					'class' =>'form-check-input'
				]); 
				?>
			</div>
<div class="row">
	<div class="col-6">
	<?php echo $this->Form->control('log_from',[
				  'class' => 'form-control form-control-sm datepicker-here', 
				  'label' => 'Log From',
				  'id' => 'log_from',
				  'type' => 'Text',
				  'data-language' => 'en',
				  'data-date-format' => 'Y-m-d',
				  'empty'=>'empty',
				  'required' => false,
				  'autocomplete' => 'off'
	]); ?>
	</div>
	<div class="col-6">
	<?php echo $this->Form->control('log_to',[
				  'class' => 'form-control form-control-sm datepicker-here', 
				  'label' => 'Log To',
				  'id' => 'log_to',
				  'type' => 'Text',
				  'data-language' => 'en',
				  'data-date-format' => 'Y-m-d',
				  'empty'=>'empty',
				  'required' => false,
				  'autocomplete' => 'off'
	]); ?>
	</div>
</div>
<script type="text/javascript">
$('#log_from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});

$('#log_to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
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




<script>
 function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>