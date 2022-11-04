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
<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
</li>
<li class="nav-item">
<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug],['class' => 'nav-link', 'escapeTitle' => false]) ?>	
</li>
</ul>
<div class="card shadow mb-4">
<div class="p-3">
<div class="table-responsive">
	<table class="table">
		<tr>
			<th><?= $this->Paginator->sort('id','Log') ?></th>
			<th><?= $this->Paginator->sort('type','Activity') ?></th>
			<th><?= $this->Paginator->sort('primary_key','PK') ?></th>
			<th><?= $this->Paginator->sort('source') ?></th>
			<th><?= $this->Paginator->sort('created','Logged on') ?></th>
			<th class="text-center"><?= __('Actions') ?></th>
		</tr>
<?php foreach ($auditLogs as $auditLog): ?>	
<tr>
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
			<td class="actions text-center">
	<div class="btn-group shadow" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('<i class="far fa-folder-open"></i> View'), ['controller' => 'auditLogs', 'action' => 'view', $auditLog->id], ['class' => 'btn btn-outline-primary btn-sm', 'escapeTitle' => false, 'target' => 'blank']) ?>
	</div>
			</td>
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
      <i class="fa-solid fa-timeline fa-xl" style="margin-left: 10px;margin-top: 22px;"></i>
    </div>
		<div class="card-body small-text pt-0">
	<div class="fw-semibold fs-5 py-0">Audit Trail</div>
<div class="mb-3 col-12 mb-0">
<div class="alert alert-warning">
<h6 class="alert-heading fw-bold mb-1">Check full audit trail</h6>
<p class="mb-0">View all changes for <?php echo $user->fullname; ?> account data in audit trail management.</p>
</div>
</div>

<div class="text-end mb-2">
<?php
echo $this->Html->link('Audit Trail', ['controller' => 'auditLogs', '?' => ['primary_key' => $user->id]],['class' => 'btn btn-outline-primary', 'target' => 'blank']);
?>
</div>

		</div>
  </div>
</div>
	</div>
</div>







