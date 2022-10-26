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
							['action' => 'delete', $auditLog->id],
							['confirm' => __('Are you sure you want to delete # {0}?', $auditLog->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
						) ?></li>
												<li><hr class="dropdown-divider"></li>
						<li><?= $this->Html->link(__('List Audit Logs'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
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
 * @var \App\Model\Entity\AuditLog $auditLog
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="auditLogs form content">
            <?= $this->Form->create($auditLog) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('transaction');
                    echo $this->Form->control('type');
                    echo $this->Form->control('primary_key');
                    echo $this->Form->control('source');
                    echo $this->Form->control('parent_source');
                    echo $this->Form->control('original');
                    echo $this->Form->control('changed');
                    echo $this->Form->control('meta');
                ?>
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'disabled' => 'disabled', 'class' => 'btn btn-outline-primary']) ?>
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
				The User Experience Designer position exists to create compelling and digital user experience through excellent design...
				</div>
		  </div>
		</div>
	</div>
</div>

