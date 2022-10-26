<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
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
            <li><?= $this->Html->link(__('Edit Faq'), ['action' => 'edit', $faq->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><?= $this->Form->postLink(__('Delete Faq'), ['action' => 'delete', $faq->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><hr class="dropdown-divider"></li>
			<li><?= $this->Html->link(__('List Faqs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
            <li><?= $this->Html->link(__('New Faq'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					
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

    <div class="column-responsive column-80">
        <div class="faqs view content">
            <table table class="table table-hovered table-sm">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($faq->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= h($faq->category) ?></td>
                </tr>
                <tr>
                    <th><?= __('Question') ?></th>
                    <td><?= h($faq->question) ?></td>
                </tr>
                <tr>
                    <th><?= __('Answer') ?></th>
                    <td><?= h($faq->answer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($faq->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($faq->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($faq->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($faq->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card shadow">
			<div class="card-body">

			</div>
		</div>
	</div>
</div>


<?php foreach ($auditLogs as $auditLog): ?>	
	<li class="list-group-item text-secondary"><?= h($auditLog->meta) ?></li>
	<?php $info = json_decode($auditLog->meta); ?>
	<?php echo $info->url; ?>
<?php endforeach; ?>
