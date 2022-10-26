<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->css('prism.css');
	//echo $this->Html->script('prism.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('ckeditor/ckeditor.js');
	//echo $this->Html->script('ckfinder/ckfinder.js');
	//echo $this->Html->css('jquery.datetimepicker.min.css');
	//echo $this->Html->script('jquery.datetimepicker.full.js');
	//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>

<div class="row">
	<div class="col-md-9">
<div class="card shadow">
	<div class="card-header d-flex align-items-center justify-content-between border-bottom">
		<div class="card-title mb-0">
		  <h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		  <small class="text-muted"><?php echo $system_name; ?></small>
		</div>
		<div class="dropdown">
		  <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-ellipsis-vertical"></i>
		  </button>
		  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
			<a class="dropdown-item" href="javascript:void(0);">Select All</a>
			<a class="dropdown-item" href="javascript:void(0);">Refresh</a>
			<a class="dropdown-item" href="javascript:void(0);">Share</a>
		  </div>
		</div>
	</div>
	<div class="card-body mt-4">
<?php echo $this->Form->create($todo); ?>
                <fieldset>
<?php echo $this->Form->control('user_id', ['options' => $users]); ?>
<?php echo $this->Form->control('task',['required' => false]); ?>

<div class="row">
	<div class="col-4">
<label>Priority</label><br>
		<?php
			echo $this->Form->radio(
				'urgency',
				[
					['value' => 'Low', 'text' => 'Low', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
					['value' => 'Medium', 'text' => 'Medium', 'label' => ['class' => 'btn btn-outline-warning ms-1 mb-3']],
					['value' => 'High', 'text' => 'High', 'label' => ['class' => 'btn btn-outline-danger ms-1 mb-3']],
				]
			);?>
	</div>
	<div class="col-8">
<label>Status</label><br>
		<?php
			echo $this->Form->radio(
				'status',
				[
					['value' => 'Pending', 'text' => 'Pending', 'label' => ['class' => 'btn btn-outline-warning ms-1 mb-3']],
					['value' => 'In Progress', 'text' => 'In Progress', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
					['value' => 'Completed', 'text' => 'Completed', 'label' => ['class' => 'btn btn-outline-success ms-1 mb-3']],
					['value' => 'Canceled', 'text' => 'Canceled', 'label' => ['class' => 'btn btn-outline-danger ms-1 mb-3']],
				]
			);?>
	</div>
</div>


<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
<?php echo $this->Form->control('description',['required' => false, 'id' => 'ckeditor', 'label' => 'Description']); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php echo $this->Form->control('note',['required' => false, 'id' => 'ckeditor2', 'label' => 'Note']); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor2' ) )
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
				
<script>
var checkboxes = $("input[type='checkbox']"),
    submitButton = $("button[type='submit']");

checkboxes.click(function() {
    submitButton.attr("disabled", !checkboxes.is(":checked"));
});
</script>

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


<script type="text/javascript">
$(document).ready(function() {
  $(".input select").select2();
});
</script>