<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Contact> $contacts
 */
?>
<div class="contacts index content">
    <?= $this->Html->link(__('New Contact'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contacts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('ticket') ?></th>
                    <th><?= $this->Paginator->sort('subject') ?></th>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('ip') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('respond_date_time') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= $this->Number->format($contact->id) ?></td>
                    <td><?= $contact->has('user') ? $this->Html->link($contact->user->id, ['controller' => 'Users', 'action' => 'view', $contact->user->id]) : '' ?></td>
                    <td><?= h($contact->ticket) ?></td>
                    <td><?= h($contact->subject) ?></td>
                    <td><?= h($contact->category) ?></td>
                    <td><?= h($contact->name) ?></td>
                    <td><?= h($contact->email) ?></td>
                    <td><?= h($contact->ip) ?></td>
                    <td><?= h($contact->status) ?></td>
                    <td><?= h($contact->respond_date_time) ?></td>
                    <td><?= h($contact->slug) ?></td>
                    <td><?= h($contact->created) ?></td>
                    <td><?= h($contact->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contact->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
