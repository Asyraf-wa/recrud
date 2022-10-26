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
            <?= $this->Html->link(__('List Settings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="settings form content">
            <?= $this->Form->create($setting) ?>
            <fieldset>
                <legend><?= __('Add Setting') ?></legend>
                <?php
                    echo $this->Form->control('system_name');
                    echo $this->Form->control('system_abbr');
                    echo $this->Form->control('system_slogan');
                    echo $this->Form->control('organization_name');
                    echo $this->Form->control('domain_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('notification_email');
                    echo $this->Form->control('meta_title');
                    echo $this->Form->control('meta_keyword');
                    echo $this->Form->control('meta_subject');
                    echo $this->Form->control('meta_copyright');
                    echo $this->Form->control('meta_desc');
                    echo $this->Form->control('timezone');
                    echo $this->Form->control('author');
                    echo $this->Form->control('site_status');
                    echo $this->Form->control('user_reg');
                    echo $this->Form->control('config_2');
                    echo $this->Form->control('config_3');
                    echo $this->Form->control('version');
                    echo $this->Form->control('private_key_from_recaptcha');
                    echo $this->Form->control('public_key_from_recaptcha');
                    echo $this->Form->control('banned_username');
                    echo $this->Form->control('telegram_bot_token');
                    echo $this->Form->control('telegram_chatid');
                    echo $this->Form->control('hcaptcha_sitekey');
                    echo $this->Form->control('hcaptcha_secretkey');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
