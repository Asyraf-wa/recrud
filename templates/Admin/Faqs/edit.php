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
												<li><?= $this->Form->postLink(
							__('Delete'),
							['action' => 'delete', $faq->id],
							['confirm' => __('Are you sure you want to delete # {0}?', $faq->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
						) ?></li>
												<li><hr class="dropdown-divider"></li>
						<li><?= $this->Html->link(__('List Faqs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					</div>
			</div>	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-9">
		<div class="card shadow">
			<div class="card-body">
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="faqs form content">
            <?= $this->Form->create($faq) ?>
            <fieldset>
<div class="row">
	<div class="col-md-6">
<label>Category</label><br>
<?php echo $this->Form->radio(
		'category',
		[
			['value' => 'General', 'text' => 'General', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
			['value' => 'Account', 'text' => 'Account', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
			['value' => 'Other', 'text' => 'Other', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
		],
		['class' => 'form-control','required' => false]
	);
	if ($this->Form->isFieldError('category')) {
		echo $this->Form->error('category', 'Please select category');
	} ?>

	</div>
	<div class="col-md-6">
<label>Status</label><br>
<?php echo $this->Form->radio(
	'status',
	[
		['value' => '0', 'text' => 'Disabled', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
		['value' => '1', 'text' => 'Active', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
		['value' => '2', 'text' => 'Archived', 'label' => ['class' => 'btn btn-outline-primary ms-1 mb-3']],
	],
	['class' => 'form-control','required' => false]
);
if ($this->Form->isFieldError('status')) {
	echo $this->Form->error('status', 'Please select status');
} ?>

	</div>
</div>
                    <?php echo $this->Form->control('question'); ?>
                    <?php echo $this->Form->control('answer'); ?>
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit',  'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
        </div>
    </div>
</div>

			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="special_card mb-3">
		  <div class="profile-card js-profile-card shadow">
			<div class="profile-card__img shadow" style="background-color: #dc3545;color: #ffffff;">
			  <i class="fa-solid fa-question fa-xl" style="margin-left: 16px;margin-top: 21px;"></i>
			</div>
				<div class="card-body small-text pt-0">
There are three (3) default categories for frequently asked questions:
<ol>
	<li>General</li>
	<li>Account</li>
	<li>Other</li>
</ol>

Only status active question will be render in FAQ list.
				</div>
		  </div>
		</div>
	</div>
</div>

