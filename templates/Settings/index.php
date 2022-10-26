<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Setting> $settings
 */
?>
<div class="settings index content">
    <?= $this->Html->link(__('New Setting'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Settings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('system_name') ?></th>
                    <th><?= $this->Paginator->sort('system_abbr') ?></th>
                    <th><?= $this->Paginator->sort('system_slogan') ?></th>
                    <th><?= $this->Paginator->sort('organization_name') ?></th>
                    <th><?= $this->Paginator->sort('domain_name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('notification_email') ?></th>
                    <th><?= $this->Paginator->sort('meta_title') ?></th>
                    <th><?= $this->Paginator->sort('meta_keyword') ?></th>
                    <th><?= $this->Paginator->sort('meta_subject') ?></th>
                    <th><?= $this->Paginator->sort('meta_copyright') ?></th>
                    <th><?= $this->Paginator->sort('meta_desc') ?></th>
                    <th><?= $this->Paginator->sort('timezone') ?></th>
                    <th><?= $this->Paginator->sort('author') ?></th>
                    <th><?= $this->Paginator->sort('site_status') ?></th>
                    <th><?= $this->Paginator->sort('user_reg') ?></th>
                    <th><?= $this->Paginator->sort('config_2') ?></th>
                    <th><?= $this->Paginator->sort('config_3') ?></th>
                    <th><?= $this->Paginator->sort('version') ?></th>
                    <th><?= $this->Paginator->sort('private_key_from_recaptcha') ?></th>
                    <th><?= $this->Paginator->sort('public_key_from_recaptcha') ?></th>
                    <th><?= $this->Paginator->sort('telegram_bot_token') ?></th>
                    <th><?= $this->Paginator->sort('telegram_chatid') ?></th>
                    <th><?= $this->Paginator->sort('hcaptcha_sitekey') ?></th>
                    <th><?= $this->Paginator->sort('hcaptcha_secretkey') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settings as $setting): ?>
                <tr>
                    <td><?= h($setting->id) ?></td>
                    <td><?= h($setting->system_name) ?></td>
                    <td><?= h($setting->system_abbr) ?></td>
                    <td><?= h($setting->system_slogan) ?></td>
                    <td><?= h($setting->organization_name) ?></td>
                    <td><?= h($setting->domain_name) ?></td>
                    <td><?= h($setting->email) ?></td>
                    <td><?= h($setting->notification_email) ?></td>
                    <td><?= h($setting->meta_title) ?></td>
                    <td><?= h($setting->meta_keyword) ?></td>
                    <td><?= h($setting->meta_subject) ?></td>
                    <td><?= h($setting->meta_copyright) ?></td>
                    <td><?= h($setting->meta_desc) ?></td>
                    <td><?= h($setting->timezone) ?></td>
                    <td><?= h($setting->author) ?></td>
                    <td><?= h($setting->site_status) ?></td>
                    <td><?= h($setting->user_reg) ?></td>
                    <td><?= h($setting->config_2) ?></td>
                    <td><?= h($setting->config_3) ?></td>
                    <td><?= h($setting->version) ?></td>
                    <td><?= h($setting->private_key_from_recaptcha) ?></td>
                    <td><?= h($setting->public_key_from_recaptcha) ?></td>
                    <td><?= h($setting->telegram_bot_token) ?></td>
                    <td><?= h($setting->telegram_chatid) ?></td>
                    <td><?= h($setting->hcaptcha_sitekey) ?></td>
                    <td><?= h($setting->hcaptcha_secretkey) ?></td>
                    <td><?= h($setting->created) ?></td>
                    <td><?= h($setting->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $setting->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?>
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
