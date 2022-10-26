<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contact $contact
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contact->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Contacts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contacts form content">
            <?= $this->Form->create($contact) ?>
            <fieldset>
                <legend><?= __('Edit Contact') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('ticket');
                    echo $this->Form->control('subject');
                    echo $this->Form->control('category');
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('note_admin');
                    echo $this->Form->control('ip');
                    echo $this->Form->control('status');
                    echo $this->Form->control('respond_date_time');
                    echo $this->Form->control('slug');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
