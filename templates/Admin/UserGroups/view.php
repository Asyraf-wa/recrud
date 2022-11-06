<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserGroup $userGroup
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Group'), ['action' => 'edit', $userGroup->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Group'), ['action' => 'delete', $userGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userGroup->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Groups'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Group'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userGroups view content">
            <h3><?= h($userGroup->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($userGroup->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userGroup->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($userGroup->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($userGroup->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($userGroup->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($userGroup->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Group Id') ?></th>
                            <th><?= __('Fullname') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Avatar Dir') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Is Email Verified') ?></th>
                            <th><?= __('Last Login') ?></th>
                            <th><?= __('Ip Address') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($userGroup->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->user_group_id) ?></td>
                            <td><?= h($users->fullname) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->avatar) ?></td>
                            <td><?= h($users->avatar_dir) ?></td>
                            <td><?= h($users->token) ?></td>
                            <td><?= h($users->status) ?></td>
                            <td><?= h($users->is_email_verified) ?></td>
                            <td><?= h($users->last_login) ?></td>
                            <td><?= h($users->ip_address) ?></td>
                            <td><?= h($users->slug) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td><?= h($users->created_by) ?></td>
                            <td><?= h($users->modified_by) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
