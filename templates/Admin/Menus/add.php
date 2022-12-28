<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
	//echo $this->Html->script('https://unpkg.com/feather-icons'); 
?>
                <?php $this->Form->setTemplates([
				'inputContainer' => '<div class="mb-3">{{content}}</div>',
				'inputContainerError' => '<div class="mb-1 input {{type}}{{required}} is-invalid ">{{content}}{{error}}</div>',
                ]); ?>
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
					<li><?= $this->Html->link(__('<i class="fa-solid fa-list"></i> Menu Management'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					</div>
			</div>	
		</div>
	</div>
</div>

<div class="row mt-3">
	<div class="col-md-8">
<div class="card shadow">
	<div class="card-body">
		<?= $this->Form->create($menu) ?>
		<fieldset>
			<div class="row">
				<div class="col-md-6">
                <?php
                echo $this->Form->control(
                    'parent_id',
                    [
                        'escape' => false,
                        'options' => $parentMenus, 'empty' => true, 'required' => false, 'class' => 'form-control form-select', 'id' => 'parent',
                    ]
                ); ?>
<script type="text/javascript">
$('#parent').select2({
    placeholder: "Select Parent Menu",
});
</script>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('level'); ?> <code>No Parent Menu = 0, if have Parent Menu = 1</code>
					<?php echo $this->Form->control('level',['required' => false, 'label' => false]); ?>
					
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('name','Menu Name'); ?>
					<?php echo $this->Form->control('name',['required' => false, 'label' => false, 'placeholder' => 'User Management']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('url'); ?> <code>controller:action EG: User:index</code>
					<?php echo $this->Form->control('url',['required' => false, 'label' => false, 'placeholder' => 'User:index']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('icon'); ?> <code>Font Awesome 6 Icon: <?php echo $this->Html->link('<i class="fa-solid fa-up-right-from-square"></i> Open', 'https://fontawesome.com/search?o=r&m=free', ['class' => 'btn btn-primary btn-xs', 'target' => '_blank', 'escapeTitle' => false]); ?></code>
					<?php echo $this->Form->control('icon',['required' => false, 'label' => false, 'placeholder' => '<i class="fa-solid fa-skull"></i>']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('controller'); ?> <code>Controller name</code>
					<?php echo $this->Form->control('controller',['required' => false, 'label' => false, 'placeholder' => 'Users']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('action'); ?> <code>Action name</code>
					<?php echo $this->Form->control('action',['required' => false, 'label' => false, 'placeholder' => 'Index']); ?>
				</div>
				<div class="col-md-6">
					<?php echo $this->Form->label('prefix'); ?> <code>Prefix EG: Admin</code>
					<?php echo $this->Form->control('prefix',['required' => false, 'label' => false, 'placeholder' => 'Admin']); ?>
				</div>
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('auth', ['class'=>'form-check-input shadow', 'id'=>'auth']); ?>
					&nbsp;<label for="auth">Authentication</label> <code>Check if the menu is rendered when user authenticate</code>
				</div>
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('admin', ['class'=>'form-check-input shadow', 'id'=>'admin']); ?>
					&nbsp;<label for="admin">Administrator</label> <code>Check if the menu is rendered when authenticated user is administrator</code>
				</div>
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('active', ['class'=>'form-check-input shadow', 'id'=>'active']); ?>
					&nbsp;<label for="active">Active</label> <code>Check if the menu is active and rendered in view</code>
				</div>
				<!--<div class="col-md-12">
					<?php //echo $this->Form->checkbox('disabled', ['class'=>'form-check-input shadow', 'id'=>'disabled']); ?>
					&nbsp;<label for="disabled">Disabled</label> <code>Controller</code>
				</div>-->
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('divider_before', ['class'=>'form-check-input shadow', 'id'=>'divider_before']); ?>
					&nbsp;<label for="divider_before">Divider Before</label> <code>Check if you need divider in sub-menu</code>
				</div>
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('division', ['class'=>'form-check-input shadow', 'id'=>'division']); ?>
					&nbsp;<label for="division">Division</label> <code>Check if this menu act as a division. The division is a separator between menu categories </code>
				</div>
				<div class="col-md-12">
					<?php echo $this->Form->checkbox('parent_separator', ['class'=>'form-check-input shadow', 'id'=>'parent_separator']); ?>
					&nbsp;<label for="parent_separator">Parent Menu</label> <code>Check if this menu act as a parent menu. The parent contains child menu </code>
				</div>
			</div>


		</fieldset>
				<div class="text-end mt-3">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
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
	<div class="col-md-4">
<div class="special_card mb-3">
  <div class="profile-card js-profile-card shadow">
    <div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
      <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i>
    </div>
		<div class="card-body small-text pt-0">
		<ul>
			<li><span class="badge bg-info">Parent</span> menu will be populate based on the registered menu or links.</li>
			<li><span class="badge bg-info">Level</span> define the menu parent or child. No Parent Menu = 0, if have Parent Menu = 1. Eg: Administrator [0] and User Management [1] is child to Administrator menu.</li>
			<li><span class="badge bg-info">Menu Name</span> render the menu title as shown in the side bar.</li>
			<li>The <span class="badge bg-info">URL</span> input is the specific link to the resource:</li>
				<ul>
					<li>Normal link: Controller:Action</li>
					<li>If have prefix: Prefix:Controller:Action</li>
					<li>If prefix is false: ..:Controller:Action</li>
					<li>External link: https://codethepixel.com</li>
				</ul>
			<li>Font-Awesome <span class="badge bg-info">Icon</span> render the menu icon. Select the icon from <?php echo $this->Html->link('here', 'https://fontawesome.com/search?o=r&m=free', ['class' => '', 'target' => '_blank', 'escapeTitle' => false]); ?>. Limited to free icon only.</li>
			<li>The <span class="badge bg-info">Controller</span> name is required to make the current selected menu active.</li>
			<li>If the menu only have limited access for authenticated user, check the <span class="badge bg-info">Authentication</span> checkbox.</li>
			<li>Check the <span class="badge bg-info">Active</span> to activate and render the menu.</li>
			<li>Check the <span class="badge bg-info">Divider Before</span> to create a divider (line between child menu).</li>
			<li>Check the <span class="badge bg-info">Division</span> to create menu division/section. </li>
		</ul>
		</div>
  </div>
</div>
	</div>
</div>