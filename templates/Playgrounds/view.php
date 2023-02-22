<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playground $playground
 */
?>
<!--Header-->
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
            <li><?= $this->Html->link(__('Edit Playground'), ['action' => 'edit', $playground->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><?= $this->Form->postLink(__('Delete Playground'), ['action' => 'delete', $playground->id], ['confirm' => __('Are you sure you want to delete # {0}?', $playground->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><hr class="dropdown-divider"></li>
			<li><?= $this->Html->link(__('List Playgrounds'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><?= $this->Html->link(__('New Playground'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					
					</div>
			</div>	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-9">
		<div class="card shadow">
			<div class="card-body">

<div class="row">
    <div class="table-responsive">
            <table table class="table table-hovered table-sm">
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($playground->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($playground->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($playground->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($playground->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($playground->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= h($playground->deleted) ?></td>
                </tr>
            </table>
    </div>
</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
	
<div class="card shadow border mb-3">
	<div class="card-body">
		<div class="row row-cols-auto mb-3">
			<div class="col pe-0">
				<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
				<i class="fa-solid fa-triangle-exclamation fa-xl" style="margin-left: 11px;margin-top: 21px;"></i>
				</div>	
			</div>
		<div class="col">
			<h5 class="card_title_custom mb-0 mt-1">Archived playground</h5>
			<div class="card_subtitle_custom text-muted"><?php echo $system_name; ?></div>	
		</div>
		</div>	
	<div class="card-text pt-0">
<?php if($playground->status == 0 || $playground->status == 1): ?>
<div class="mb-3 col-12 mb-0">
  <div class="alert alert-warning">
	<p class="mb-0">This step will transfer the playground to archived. Once transfer to archived, it will remained and cannot be revert back. Please be certain.</p>
  </div>
</div>

<div class="text-end mb-2">
<?= $this->Form->postLink(
				__('Archived'),
				['action' => 'archived', $playground->id],
				[
					'confirm' => __('Are you sure you want to archived playground: "{0}"?', $playground->id),
					'title' => __('Archived'),
					'class' => 'btn btn-success',
					'escapeTitle' => false,
					'data-bs-toggle' => "modal",
					'data-bs-target' => "#bootstrapModal"
				]
			) ?>

</div>
<?php endif; ?>	

<?php if($playground->status == 2): ?>
This playground has been archived on <?php echo date('M d, Y (h:i A)', strtotime($playground->modified)); ?>
<?php endif; ?>	
	</div>
	</div>	
</div>
	
	</div>
</div>
