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
<div class="p-3">
			<?= $this->Form->create($user, ['type' => 'file']); ?>

            <fieldset>
<div class="row">
	<div class="col-md-2" align="center">
<?php if ($user->avatar != NULL) {
		echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['class'=> 'img-circle', 'width' => '100px', 'height' => '100px']);
	}else
		echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'img-circle', 'width' => '100px', 'height' => '100px']);
?>
	</div>
	<div class="col-md-10">
	Are confirm to remove your profile picture?
			<div class="form-group">
				<?php echo $this->Form->hidden('avatar', ['value' => '', 'class' => 'form-control','required' => false]); ?>
				<?php echo $this->Form->hidden('avatar_dir', ['value' => '', 'class' => 'form-control','required' => false]); ?>
			</div>	
	</div>
</div>
	
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button(__('Yes'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
</div>
</div>
	</div>
	<div class="col-md-4">
<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
      <i class="fa-solid fa-timeline fa-xl" style="margin-left: 10px;margin-top: 21px;"></i>
    </div>
		<div class="card-body small-text pt-0">
		Please use appropriate profile picture.
		</div>
  </div>
</div>
	</div>
</div>







