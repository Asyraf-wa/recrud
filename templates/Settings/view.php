<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Setting'), ['action' => 'edit', $setting->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Setting'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Settings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Setting'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="settings view content">
            <h3><?= h($setting->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($setting->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('System Name') ?></th>
                    <td><?= h($setting->system_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('System Abbr') ?></th>
                    <td><?= h($setting->system_abbr) ?></td>
                </tr>
                <tr>
                    <th><?= __('System Slogan') ?></th>
                    <td><?= h($setting->system_slogan) ?></td>
                </tr>
                <tr>
                    <th><?= __('Organization Name') ?></th>
                    <td><?= h($setting->organization_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Domain Name') ?></th>
                    <td><?= h($setting->domain_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($setting->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notification Email') ?></th>
                    <td><?= h($setting->notification_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Title') ?></th>
                    <td><?= h($setting->meta_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Keyword') ?></th>
                    <td><?= h($setting->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Subject') ?></th>
                    <td><?= h($setting->meta_subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Copyright') ?></th>
                    <td><?= h($setting->meta_copyright) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Desc') ?></th>
                    <td><?= h($setting->meta_desc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timezone') ?></th>
                    <td><?= h($setting->timezone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author') ?></th>
                    <td><?= h($setting->author) ?></td>
                </tr>
                <tr>
                    <th><?= __('Version') ?></th>
                    <td><?= h($setting->version) ?></td>
                </tr>
                <tr>
                    <th><?= __('Private Key From Recaptcha') ?></th>
                    <td><?= h($setting->private_key_from_recaptcha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Public Key From Recaptcha') ?></th>
                    <td><?= h($setting->public_key_from_recaptcha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telegram Bot Token') ?></th>
                    <td><?= h($setting->telegram_bot_token) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telegram Chatid') ?></th>
                    <td><?= h($setting->telegram_chatid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hcaptcha Sitekey') ?></th>
                    <td><?= h($setting->hcaptcha_sitekey) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hcaptcha Secretkey') ?></th>
                    <td><?= h($setting->hcaptcha_secretkey) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($setting->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($setting->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Site Status') ?></th>
                    <td><?= $setting->site_status ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('User Reg') ?></th>
                    <td><?= $setting->user_reg ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Config 2') ?></th>
                    <td><?= $setting->config_2 ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Config 3') ?></th>
                    <td><?= $setting->config_3 ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Banned Username') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->banned_username)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
