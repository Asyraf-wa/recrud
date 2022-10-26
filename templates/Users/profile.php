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
<div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-account" aria-controls="navs-pills-top-account" aria-selected="true"><i class="fa-solid fa-user-astronaut"></i> Account</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-update" aria-controls="navs-pills-top-update" aria-selected="false"><i class="fa-regular fa-pen-to-square"></i> Update</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-password" aria-controls="navs-pills-top-password" aria-selected="false"><i class="fa-solid fa-unlock"></i> Password</button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-activity" aria-controls="navs-pills-top-activity" aria-selected="false"><i class="fa-solid fa-timeline"></i> Activities</button>
        </li>
        <li class="nav-item">
			<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
        </li>
      </ul>
      <div class="tab-content p-0">
        <div class="tab-pane fade show active" id="navs-pills-top-account" role="tabpanel">


<div class="card bg-gold">
<div class="p-3">
<?php if ($user->avatar != NULL) {
echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['class'=> 'd-block rounded shadow', 'width'=>'130px', 'height'=>'130px']);
}else
echo $this->Html->image('blank_profile.png', ['class'=> 'd-block rounded shadow', 'width'=>'130px', 'height'=>'130px']);
?>
</div>

</div>



<div class="row mt-3 px-3">
	<div class="col-md-9">
<div class="table-responsive">
	<table class="table table-borderless table-sm">
		<tr>
			<th width="20%">Name</th>
			<td><?= h($user->fullname) ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?= h($user->email) ?></td>
		</tr>
		<tr>
			<th>Group</th>
			<td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td>
			<?php if ($user->status == 1){
				echo '<span class="badge bg-success">Active</span>';
			}elseif ($user->status == 0){
				echo '<span class="badge bg-danger">Disabled</span>';
			}else
				echo '<span class="badge bg-secondary">Archived</span>';
			?>
			</td>
		</tr>
		<tr>
			<th>Verified</th>
			<td>
<?php if ($user->is_email_verified == 1){
	echo '<span class="badge bg-success">Verified</span>';
}else
	echo '<span class="badge bg-danger">Not verified</span>';
?>
			</td>
		</tr>
		<tr>
			<th>Created on</th>
			<td><?php echo date('M d, Y (h:i A)', strtotime($user->created)); ?></td>
		</tr>
	</table>
</div>
	</div>
	<div class="col-md-3 ms-0 text-center">
			<div id="qr" align="center"></div>
			<script type="text/javascript">
				const qrCode = new QRCodeStyling({
					width: 130,
					height: 130,
					margin: 0,
					//type: "svg",
					data: "<?php echo $this->request->getUri(); ?>",
					dotsOptions: {
						//color: "#4267b2",
						type: "dots"
					},
					cornersSquareOptions: {
						type: "dots",
						color: "#007bff",
					},
					cornersDotOptions: {
						type: "dots"
					},
					backgroundOptions: {
						//color: "#ffffff",
					},
					imageOptions: {
						crossOrigin: "anonymous",
						margin: 20
					}
				});

				qrCode.append(document.getElementById("qr"));
				//qrCode.download({ name: "qr", extension: "png" });
			</script>
			

	</div>
</div>


        </div>
        <div class="tab-pane fade" id="navs-pills-top-update" role="tabpanel">
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
				
<div class="row">
	<div class="col-md-6">
	  <?php echo $this->Form->control('fullname',['required' => false]); ?>
	</div>
	<div class="col-md-6">
	  <?php echo $this->Form->control('email',['required' => false]); ?>
	</div>
</div>				
	
<?php echo $this->Form->control('slug',['required' => false]); ?>

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





                </fieldset>
				<div class="text-end">
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
				


</div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-password" role="tabpanel">
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
        <div class="tab-pane fade" id="navs-pills-top-activity" role="tabpanel">
<div class="p-3">
bbb
</div>
        </div>
      </div>
    </div>
	</div>
	<div class="col-md-4">
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

<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
      <i class="fa-solid fa-triangle-exclamation fa-xl" style="margin-left: 11px;margin-top: 21px;"></i>
    </div>
	<h5 class="card-header py-0">Deactivate Account</h5>
		<div class="card-body small-text pt-0">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to deactivate your account?</h6>
            <p class="mb-0">Once you deactivate your account, there is no going back. Please be certain.</p>
          </div>
        </div>
		
<?php echo $this->Form->checkbox('terms', ['value' => 'terms', 'class'=>'form-check-input shadow', 'id'=>'terms']); ?>
&nbsp;<label for="terms">I agree to deactivate this account.</label>
				<div class="text-end">
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'disabled' => 'disabled', 'class' => 'btn btn-danger']) ?>
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





