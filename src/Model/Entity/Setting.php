<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property string $id
 * @property string $system_name
 * @property string $system_abbr
 * @property string $system_slogan
 * @property string $organization_name
 * @property string $domain_name
 * @property string $email
 * @property string $notification_email
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_subject
 * @property string $meta_copyright
 * @property string $meta_desc
 * @property string $timezone
 * @property string $author
 * @property bool $site_status
 * @property bool $user_reg
 * @property bool $config_2
 * @property bool $config_3
 * @property string $version
 * @property string|null $private_key_from_recaptcha
 * @property string|null $public_key_from_recaptcha
 * @property string|null $banned_username
 * @property string|null $telegram_bot_token
 * @property string|null $telegram_chatid
 * @property string|null $hcaptcha_sitekey
 * @property string|null $hcaptcha_secretkey
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Setting extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'system_name' => true,
        'system_abbr' => true,
        'system_slogan' => true,
        'organization_name' => true,
        'domain_name' => true,
        'email' => true,
        'notification_email' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_subject' => true,
        'meta_copyright' => true,
        'meta_desc' => true,
        'timezone' => true,
        'author' => true,
        'site_status' => true,
        'user_reg' => true,
        'config_2' => true,
        'config_3' => true,
        'version' => true,
        'private_key_from_recaptcha' => true,
        'public_key_from_recaptcha' => true,
        'banned_username' => true,
        'telegram_bot_token' => true,
        'telegram_chatid' => true,
        'hcaptcha_sitekey' => true,
        'hcaptcha_secretkey' => true,
        'created' => true,
        'modified' => true,
    ];
}
