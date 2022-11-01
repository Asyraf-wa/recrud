<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
<small class="text-muted"><?php echo $system_name; ?></small>

<div class="row mt-3">
	<div class="col-md-8">
<ul class="nav nav-pills flex-column flex-md-row mb-3">
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
</li>
</ul>
<div class="card shadow mb-4">
<div class="p-3">
<?php echo $this->Form->create($user, ['url' => ['action' => 'change_password']]); ?>
<fieldset>
	<div class="form-group">
		<?php echo $this->Form->control('current_password', ['class' => 'form-control','required' => false, 'value' => '','autocomplete' => 'off', 'type'=>'password', 'id'=>'myPassword']); ?>
	</div>

	<div class="row">
		<div class="col-md-6">
	<div class="form-group">
		<?php echo $this->Form->control('password', ['class' => 'form-control','required' => false, 'label'=>'New Password', 'value' => '','autocomplete' => 'off', 'type'=>'password', 'id'=>'myPassword2']); ?>
	</div>
		</div>
		<div class="col-md-6">
	<div class="form-group">
		<?php echo $this->Form->control('cpassword', ['class' => 'form-control', 'type'=>'password', 'label'=>'Confirm New Password','required' => false, 'value' => '','autocomplete' => 'off', 'type'=>'password', 'id'=>'myPassword3']);?>
	</div>
		</div>
	</div>
</fieldset>

<?php echo $this->Form->checkbox('showPass', ['value' => 'showPass', 'class'=>'form-check-input shadow', 'id'=>'showPass', 'onclick'=>'myFunction()']); ?>
&nbsp;<label for="showPass">Show Password</label>


<script>
function myFunction() {
  var x = document.getElementById("myPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x = document.getElementById("myPassword2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  var x = document.getElementById("myPassword3");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
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
      <i class="fa-solid fa-unlock fa-xl" style="margin-left: 12px;margin-top: 21px;"></i>
    </div>
		<div class="card-body small-text pt-0">
		Password security tips:
			<ul>
				<li>Minimum 8 characters</li>
				<li>Combination of alphabet, number and symbol</li>
				<li>Do not use username as password</li>
			</ul>
		</div>
  </div>
</div>
	</div>
</div>







