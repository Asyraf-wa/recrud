<?php
	use Cake\Routing\Router;
	//echo $this->Html->css('select2/css/select2.css');
	//echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->script('ckeditor/ckeditor.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
	//$c_name = $this->request->getParam('controller');
	//echo $this->Html->script('bootstrapModal', ['block' => true]);
	echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
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
			<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Contact Ticket'), ['controller' => 'Contacts', 'action' => 'add', 'prefix' => false], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
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
<div class="card shadow">
	<div class="card-body">
	
	<span class="info_pill bg-secondary">Ticket No</span><span class="info_pill bg-info"><?= h($contact->ticket) ?></span>
	<span class="info_pill bg-secondary">Status</span><?php if($contact->status == 0){
		echo '<span class="info_pill bg-warning">Pending</span>';
	}elseif($contact->status == 1){
		echo '<span class="info_pill bg-success">Replied</span>';
	}else
		echo '<span class="info_pill bg-danger">Ignored</span>';?>
	<span class="info_pill bg-secondary">IP</span><span class="info_pill bg-info"><?= h($contact->ip) ?></span>
	<span class="info_pill bg-secondary">ID</span><span class="info_pill bg-info"><?= $this->Number->format($contact->id) ?></span>
	<span class="info_pill bg-secondary">Submitted On</span><span class="info_pill bg-info"><?= date('F d, Y', strtotime($contact->created)); ?></span>
	<span class="info_pill bg-secondary">Replied On</span><span class="info_pill bg-info"><?= date('F d, Y', strtotime($contact->respond_date_time)); ?></span>
	
		<div class="table-responsive mt-3">
			<table class="table">
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($contact->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contact->name) ?> (<?= h($contact->email) ?>)</td>
                </tr>
                <tr>
                    <th><?= __('Notes') ?></th>
                    <td class="justify"><?= ($contact->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admin reply') ?></th>
                    <td class="justify"><?= ($contact->note_admin) ?></td>
                </tr>
			</table>
		
			
		</div>
	</div>
</div>

<div class="card shadow mt-3">
	<div class="card-body">
		<?= $this->Form->create($contact) ?>
<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
<fieldset>
<?php echo $this->Form->control('note_admin',['required' => false, 'id' => 'ckeditor', 'label' => 'Reply']); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
	</div>
</div>
	</div>
	<div class="col-md-3">
<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
      <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i>
    </div>
		<div class="card-body small-text pt-0">
		The User Experience Designer position exists to create compelling and digital user experience through excellent design...
		</div>
  </div>
</div>
	</div>
</div>