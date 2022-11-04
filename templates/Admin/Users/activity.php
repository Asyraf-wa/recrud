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
<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
</li>
</ul>
<div class="card shadow mb-4">
<div class="p-3">

<div class="table-responsive">
	<table class="table table-sm table-hovered">
		<tr>
			<th>Action</th>
			<th>Agent</th>
			<th>OS</th>
			<th>IP</th>
			<th>Host</th>
			<th>Date/Time</th>
		</tr>
<?php foreach ($userLogs as $userLog): ?>	
			<tr>
			<td>
<?php if ($userLog->action == 'Login'){
	echo '<span class="badge bg-success">Login</span>';
}elseif ($userLog->action == 'Logout'){
	echo '<span class="badge bg-danger">Logout</span>';
}else
	echo '<span class="badge bg-secondary">Error</span>';
?>
			</td>
			<td><?= h($userLog->useragent) ?></td>
			<td><?= h($userLog->os) ?></td>
			<td><?= h($userLog->ip) ?></td>
			<td><?= h($userLog->host) ?></td>
			<td><?php echo date('M d, Y (h:i A)', strtotime($userLog->created)); ?></td>
		</tr>
<?php endforeach; ?>
	</table>
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
		The user activities module shows the user authentication history and other related details.
		</div>
  </div>
</div>
	</div>
</div>







