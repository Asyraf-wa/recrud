<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User Group') ?></th>
                    <td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Fullname') ?></th>
                    <td><?= h($user->fullname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avatar') ?></th>
                    <td><?= h($user->avatar) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avatar Dir') ?></th>
                    <td><?= h($user->avatar_dir) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($user->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ip Address') ?></th>
                    <td><?= h($user->ip_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($user->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Email Verified') ?></th>
                    <td><?= $this->Number->format($user->is_email_verified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $user->created_by === null ? '' : $this->Number->format($user->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $user->modified_by === null ? '' : $this->Number->format($user->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Login') ?></th>
                    <td><?= h($user->last_login) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Contacts') ?></h4>
                <?php if (!empty($user->contacts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Ticket') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Category') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Note Admin') ?></th>
                            <th><?= __('Ip') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Respond Date Time') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->contacts as $contacts) : ?>
                        <tr>
                            <td><?= h($contacts->id) ?></td>
                            <td><?= h($contacts->user_id) ?></td>
                            <td><?= h($contacts->ticket) ?></td>
                            <td><?= h($contacts->subject) ?></td>
                            <td><?= h($contacts->category) ?></td>
                            <td><?= h($contacts->name) ?></td>
                            <td><?= h($contacts->email) ?></td>
                            <td><?= h($contacts->notes) ?></td>
                            <td><?= h($contacts->note_admin) ?></td>
                            <td><?= h($contacts->ip) ?></td>
                            <td><?= h($contacts->status) ?></td>
                            <td><?= h($contacts->respond_date_time) ?></td>
                            <td><?= h($contacts->slug) ?></td>
                            <td><?= h($contacts->created) ?></td>
                            <td><?= h($contacts->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Logs') ?></h4>
                <?php if (!empty($user->user_logs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Action') ?></th>
                            <th><?= __('Useragent') ?></th>
                            <th><?= __('Os') ?></th>
                            <th><?= __('Ip') ?></th>
                            <th><?= __('Host') ?></th>
                            <th><?= __('Referrer') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_logs as $userLogs) : ?>
                        <tr>
                            <td><?= h($userLogs->id) ?></td>
                            <td><?= h($userLogs->user_id) ?></td>
                            <td><?= h($userLogs->action) ?></td>
                            <td><?= h($userLogs->useragent) ?></td>
                            <td><?= h($userLogs->os) ?></td>
                            <td><?= h($userLogs->ip) ?></td>
                            <td><?= h($userLogs->host) ?></td>
                            <td><?= h($userLogs->referrer) ?></td>
                            <td><?= h($userLogs->status) ?></td>
                            <td><?= h($userLogs->created) ?></td>
                            <td><?= h($userLogs->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserLogs', 'action' => 'view', $userLogs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserLogs', 'action' => 'edit', $userLogs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserLogs', 'action' => 'delete', $userLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userLogs->id)]) ?>
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
