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
												<li><?= $this->Form->postLink(
							__('Delete'),
							['action' => 'delete', $playground->id],
							['confirm' => __('Are you sure you want to delete # {0}?', $playground->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
						) ?></li>
												<li><hr class="dropdown-divider"></li>
						<li><?= $this->Html->link(__('List Playgrounds'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
					</div>
			</div>	
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-9">
		<div class="card shadow">
			<div class="card-body">

            <?= $this->Form->create($playground) ?>
            <fieldset>
                    <?php echo $this->Form->control('title',['required' => false]); ?>
                    <?php echo $this->Form->control('status',['required' => false]); ?>
                    <?php echo $this->Form->control('deleted', ['empty' => true]); ?>
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card shadow border mb-3">
			<div class="card-body">
					<h5 class="card_title_custom mb-0 mt-1">Title</h5>
					<div class="card_subtitle_custom text-muted mb-3"><?php echo $system_name; ?></div>		
			<div class="card-text small-text pt-0">
				Content
			</div>
			</div>	
		</div>
	</div>
</div>

