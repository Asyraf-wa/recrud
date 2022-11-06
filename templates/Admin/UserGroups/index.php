<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\UserGroup> $userGroups
 */
?>
<div class="userGroups index content">
    <?= $this->Html->link(__('New User Group'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Groups') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userGroups as $userGroup): ?>
                <tr>
                    <td><?= $this->Number->format($userGroup->id) ?></td>
                    <td><?= h($userGroup->name) ?></td>
                    <td><?= h($userGroup->created) ?></td>
                    <td><?= h($userGroup->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userGroup->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userGroup->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userGroup->id)]) ?>
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
