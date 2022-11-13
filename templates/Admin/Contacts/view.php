<?php
echo $this->Html->script('ckeditor/ckeditor.js');
?>
<div class="row mb-3">
	<div class="col-8 col-md-10">
		<h1 class="m-0 me-2 page_title"><?php echo $title; ?></h1>
		<small class="text-muted"><?php echo $system_name; ?></small>
	</div>
	<div class="col-4 col-md-2">
		<div class="text-end">
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
			<?php echo $this->Form->button ('<i class="fa-solid fa-arrow-left text-primary"></i> Back',['type' =>'button', 'onclick' =>'history.back()', 'escapeTitle' => false, 'class'=> 'btn btn-outline-primary btn-sm']); ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card shadow">
			<div class="card-body">
				<div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th><?= __('Ticket') ?></th>
                    <td><?= h($contact->ticket) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($contact->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contact->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contact->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Note') ?></th>
                    <td><?= h($contact->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ip') ?></th>
                    <td><?= h($contact->ip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td>
				<?php if ($contact->status == 1){
					echo '<i class="fas fa-circle text-success"></i>';
				}else
					echo '<i class="fas fa-circle text-danger"></i>';
				?>
					</td>
                </tr>
                <tr>
                    <th><?= __('Reply Status') ?></th>
                    <td>
				<?php if ($contact->is_replied == true){
					echo '<i class="fa-solid fa-check text-success"></i>';
				}else
					echo '<i class="fa-solid fa-xmark text-danger"></i>';
				?>
					</td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contact->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?php echo date('M d, Y (h:i A)', strtotime($contact->created)); ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?php echo date('M d, Y (h:i A)', strtotime($contact->modified)); ?></td>
                </tr>
            </table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
<?php if ($contact->is_replied == true):?>
		<div class="card shadow">
			<div class="card-body">
<div class="fw-bold">Replied on:</div>
<?= $contact->has('user') ? $this->Html->link($contact->user->id, ['controller' => 'Users', 'action' => 'view', $contact->user->id]) : '' ?>
<?php echo date('M d, Y (h:i A)', strtotime($contact->respond_date_time)); ?>.<br/><br/>
<div class="fw-bold">Response:</div>
<?php echo $contact->note_admin; ?>
			</div>
		</div>
<?php endif; ?>
<?php if ($contact->is_replied == false):?>
		<div class="card shadow">
			<div class="card-body">
        <div class="faqs form content">
            <?= $this->Form->create($contact) ?>
            <fieldset>
<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
<?php echo $this->Form->control('note_admin',['required' => false, 'id' => 'ckeditor', 'label' => 'Reply Note']); ?>
<script>
    ClassicEditor
        .create( document.querySelector( '#ckeditor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
				  <?= $this->Form->end() ?>
                </div>
        </div>
			</div>
		</div>
<?php endif; ?>
	</div>
</div>
