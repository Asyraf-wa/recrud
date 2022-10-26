<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'system_name' => 'Code The Pixel',
                'system_abbr' => 'Re-CRUD',
                'system_slogan' => 'Code The Experiences',
                'organization_name' => 'Code The Pixel Inc.',
                'domain_name' => 'codethepixel.com',
                'email' => 'noreply@codethepixel.com',
                'notification_email' => 'noreply@codethepixel.com',
                'meta_title' => 'Re-CRUD',
                'meta_keyword' => 'Re-CRUD',
                'meta_subject' => 'Re-CRUD',
                'meta_copyright' => 'Re-CRUD',
                'meta_desc' => 'Re-CRUD',
                'timezone' => 'Asia/Kuala_Lumpur',
                'author' => 'Re-CRUD',
                'site_status' => '0',
                'user_reg' => '0',
                'config_2' => '0',
                'config_3' => '0',
                'version' => '1.0',
                'private_key_from_recaptcha' => '',
                'public_key_from_recaptcha' => '',
                'banned_username' => NULL,
                'telegram_bot_token' => '',
                'telegram_chatid' => '',
                'hcaptcha_sitekey' => '',
                'hcaptcha_secretkey' => '',
                'created' => '2020-04-08 20:56:04',
                'modified' => '2022-09-30 14:03:51',
            ],
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
