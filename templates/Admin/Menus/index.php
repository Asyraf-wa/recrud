<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
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
					<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Register New Menu'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					</div>
			</div>	
		</div>
	</div>
</div>

<div class="card shadow">
	<div class="card-body">
	
		<div class="divider text-start">
			<div class="divider-text text-primary">
			Table Legend
			</div>
		</div>

<div class="table-responsive">
	<table class="table table-responsive table-borderless table-sm">
		<tr>
			<td>Auth</td>
			<td>:</td>
			<td>Check if the menu is rendered when user authenticate</td>
			<td>ADM</td>
			<td>:</td>
			<td>Check if the menu is rendered when authenticated user is administrator</td>
		</tr>
		<tr>
			<td>ATV</td>
			<td>:</td>
			<td>Check if the menu is active and rendered in view</td>
			<td>DIV</td>
			<td>:</td>
			<td>Check if you need divider in sub-menu</td>
		</tr>
		<tr>
			<td>SAP</td>
			<td>:</td>
			<td>The division is a separator between menu categories</td>
			<td>PM</td>
			<td>:</td>
			<td>Check if this menu act as a parent menu. The parent contains child menu</td>
		</tr>
	</table>
</div>

<hr/>

	
<div class="row mb-4">
	<div class="col-md-6">



	</div>
	<div class="col-md-6">


	</div>
</div>
	
	
<div class="table-responsive">
	<table class="table-responsive table table-striped table-sm">
		<thead>
			<tr>
				<th><?= $this->Paginator->sort('id') ?></th>
				<th><?= $this->Paginator->sort('parent_id') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('level') ?></th>
				<th><?= $this->Paginator->sort('name') ?></th>
				<th><?= $this->Paginator->sort('prefix') ?></th>
				<th><?= $this->Paginator->sort('controller') ?></th>
				<!--<th><?//= $this->Paginator->sort('action') ?></th>
				<th><?//= $this->Paginator->sort('target') ?></th>
				<th><?//= $this->Paginator->sort('url') ?></th>-->
				<th class="text-center"><?= $this->Paginator->sort('icon') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('authentication', 'Auth') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('admin', 'ADM') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('active','ATV') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('divider_before','Div') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('division','Sap') ?></th>
				<th class="text-center"><?= $this->Paginator->sort('parent_separator','PM') ?></th>
				<th class="actions text-center"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($menus as $menu) : ?>
				<tr>
					<td><?= $this->Number->format($menu->id) ?></td>
					<td><?= $menu->has('parent_menu') ? $this->Html->link($menu->parent_menu->name, ['controller' => 'Menus', 'action' => 'view', $menu->parent_menu->id]) : '' ?></td>
					<td class="text-center"><?= $this->Number->format($menu->level) ?></td>
					<td><?= str_repeat('&nbsp;', 3 * $menu->level) . h($menu->name) ?></td>
					<td><?= h($menu->prefix) ?></td>
					<td><b>Controller:</b> <?= h($menu->controller) ?><br/>
						<b>Action:</b> <?= h($menu->action) ?><br/>
						<b>Target:</b> <?= h($menu->target) ?><br/>
						<b>URL:</b> <?= h($menu->url) ?></td>
					<!--<td><?//= h($menu->action) ?></td>
					<td><?//= h($menu->target) ?></td>
					<td><?//= h($menu->url) ?></td>-->
					<td class="text-center"><?php echo trim($menu->icon, '"'); ?></td>
					<td class="text-center">
					<?php if($menu->auth == true){
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-check text-success"></i>'),['action' => 'deauthentication', $menu->id],['confirm' => __('Are you sure you want to De-Authenticate menu: "{0}"?', $menu->name),'title' => __('Click to De-Authenticate'),'class' => '','escapeTitle' => false]);
					}else
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-xmark text-danger"></i>'),['action' => 'authentication', $menu->id],['confirm' => __('Are you sure you want to Authenticate menu: "{0}"?', $menu->name),'title' => __('Click to Authenticate'),'class' => '','escapeTitle' => false]);
					?>
					</td>
					<td class="text-center">
					
					<?php if($menu->admin == true){
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-check text-success"></i>'),['action' => 'non_admin', $menu->id],['confirm' => __('Are you sure you want to disable admin access to menu: "{0}"?', $menu->name),'title' => __('Click to Disable'),'class' => '','escapeTitle' => false]);
					}else
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-xmark text-danger"></i>'),['action' => 'admin', $menu->id],['confirm' => __('Are you sure you want to enable admin access to menu: "{0}"?', $menu->name),'title' => __('Click to Activate'),'class' => '','escapeTitle' => false]);
					?>
					</td>
					<td class="text-center">
					<?php if($menu->active == true){
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-check text-success"></i>'),['action' => 'disable', $menu->id],['confirm' => __('Are you sure you want to disable menu: "{0}"?', $menu->name),'title' => __('Click to Disable'),'class' => '','escapeTitle' => false]);
					}else
						echo $this->Form->postLink(__('<i class="fa-regular fa-circle-xmark text-danger"></i>'),['action' => 'active', $menu->id],['confirm' => __('Are you sure you want to activate menu: "{0}"?', $menu->name),'title' => __('Click to Activate'),'class' => '','escapeTitle' => false]);
					?>
					</td>
					<td class="text-center">
					<?php if($menu->divider_before == true){
						echo '<i class="fa-regular fa-circle-check text-success"></i>';
					}else
						echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
					?>
					
					</td>
					<td class="text-center">
					<?php if($menu->division == true){
						echo '<i class="fa-regular fa-circle-check text-success"></i>';
					}else
						echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
					?>
					</td>
					<td class="text-center">
					<?php if($menu->parent_separator == true){
						echo '<i class="fa-regular fa-circle-check text-success"></i>';
					}else
						echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
					?>
					</td>
					<td class="actions text-center">
<div class="btn-group shadow" role="group" aria-label="Basic example">
<?= $this->Form->postLink(__('<i class="fa-solid fa-up-long"></i>'), ['action' => 'up', $menu->id],['class'=> 'btn btn-outline-info btn-xs', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to move up # {0}?', $menu->id)]) ?>
<?= $this->Form->postLink(__('<i class="fa-solid fa-down-long"></i>'), ['action' => 'down', $menu->id], ['class'=> 'btn btn-outline-secondary btn-xs', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to move down # {0}?', $menu->id)]) ?>
<?php echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'edit', $menu->id], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) ?>
<?php echo $this->Form->postLink(__('<i class="fa-regular fa-trash-can"></i>'), ['action' => 'removeAndDelete', $menu->id],['class'=> 'btn btn-outline-danger btn-xs', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to remove and delete # {0}?', $menu->id)]) ?>
</div>

				
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div aria-label="Page navigation" class="mt-3 px-2">
    <ul class="pagination justify-content-end flex-wrap">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} article(s) out of {{count}} total')) ?></div>
</div>
	</div>
</div>


