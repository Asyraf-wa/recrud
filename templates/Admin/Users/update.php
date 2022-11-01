<?php
	use Cake\I18n\FrozenTime;
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
	//echo $this->Html->script('https://unpkg.com/feather-icons'); 
	echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>
<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
<small class="text-muted"><?php echo $system_name; ?></small>

<div class="row mt-3">
	<div class="col-md-8">
<ul class="nav nav-pills flex-column flex-md-row mb-3">
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
</li>
</ul>
<div class="card shadow mb-4">
<div class="row p-3">
	<div class="col-md-2">
<?php if ($user->avatar != NULL) {
echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['class'=> 'd-block rounded', 'width'=>'100px', 'height'=>'100px']);
}else
echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'img-circle']);
?>
	</div>
	<div class="col-md-10 ps-0">
	<?php echo $this->Form->create($user, ['type' => 'file', 'novalidate' => true]); ?>
<?php echo $this->Form->control('avatar',['type'=>'file','required' => false, 'class' =>'form-control', 'label' => 'Profile Image']); ?>
<p class="text-muted mb-0">Allowed JPG/JPEG Only. Recommended Size 100px X 100px</p>
	</div>
</div>



<div class="p-3">

                <fieldset>
<?php
if ($this->Identity->isLoggedIn()) { ?>


<div class="row">
	<div class="col-md-6">
	  <?php echo $this->Form->control('fullname',['required' => false]); ?>
	</div>
	<div class="col-md-6">
	  <?php echo $this->Form->control('email',['required' => false]); ?>
	</div>
</div>				

<div class="row">
	<div class="col-md-6">
	  <?php 
echo $this->Form->control('user_group_id', [
	//'type' => 'text', 
	'options' => $userGroups,
	'id' => 'group',
	'label' => 'User Group',
	'class' => 'form-control',
	'required' => false]); 
?>
<script type="text/javascript">
$('#group').select2({
	tags: true,
    //data: ["Clare","Cork","South Dublin"],
    //tokenSeparators: [','], 
    placeholder: "Select",
    /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
    //selectOnClose: true, 
    //closeOnSelect: false
});
</script>
	</div>
	<div class="col-md-6">
<label>Status</label><br>
				<?php echo $this->Form->radio(
						'status',
						[
							['value' => '1', 'text' => 'Active', 'label' => ['class' => 'btn btn-outline-success ms-1 mb-3']],
							['value' => '0', 'text' => 'Disabled', 'label' => ['class' => 'btn btn-outline-danger ms-1 mb-3']],
							['value' => '2', 'text' => 'Archived', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
						],
						['class' => 'form-control','required' => false]
					);
					if ($this->Form->isFieldError('status')) {
						echo $this->Form->error('status', 'Please select score for Question 1');
					} ?>
	</div>
</div>		

<?php } ?>



                </fieldset>
				<div class="text-end">
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
				


</div>
</div>
	
	

	</div>
	<div class="col-md-4">
<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
      <i class="fa-regular fa-pen-to-square fa-xl" style="margin-left: 13px;margin-top: 21px;"></i>
    </div>
		<div class="card-body small-text pt-0">
		All information is used only for the system operation. 
		</div>
  </div>
</div>

	</div>
</div>


<?php foreach ($auditLogs as $auditLog): ?>	
	<li class="list-group-item text-secondary"><?= h($auditLog->id) ?></li>
	<?php $info = json_decode($auditLog->meta); ?>
	<?php echo $info->slug; ?>
<?php endforeach; ?>


<script type="text/javascript">
$(document).ready(function() {
  $(".input select").select2();
});
</script>





