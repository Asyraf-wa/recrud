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
<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
</li>
</ul>
<div class="card shadow mb-4">
<div class="p-3">
xxx
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
		The user activities module shows the user authentication history and other related details.
		</div>
  </div>
</div>
	</div>
</div>







