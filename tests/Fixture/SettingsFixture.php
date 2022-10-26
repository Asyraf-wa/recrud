<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SettingsFixture
 */
class SettingsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => '83892663-07fb-46ab-9188-c63725ef28c4',
                'system_name' => 'Lorem ipsum dolor sit amet',
                'system_abbr' => 'Lorem ipsum dolor sit amet',
                'system_slogan' => 'Lorem ipsum dolor sit amet',
                'organization_name' => 'Lorem ipsum dolor sit amet',
                'domain_name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'notification_email' => 'Lorem ipsum dolor sit amet',
                'meta_title' => 'Lorem ipsum dolor sit amet',
                'meta_keyword' => 'Lorem ipsum dolor sit amet',
                'meta_subject' => 'Lorem ipsum dolor sit amet',
                'meta_copyright' => 'Lorem ipsum dolor sit amet',
                'meta_desc' => 'Lorem ipsum dolor sit amet',
                'timezone' => 'Lorem ipsum dolor sit amet',
                'author' => 'Lorem ipsum dolor sit amet',
                'site_status' => 1,
                'user_reg' => 1,
                'config_2' => 1,
                'config_3' => 1,
                'version' => 'Lorem ipsum dolor sit amet',
                'private_key_from_recaptcha' => 'Lorem ipsum dolor sit amet',
                'public_key_from_recaptcha' => 'Lorem ipsum dolor sit amet',
                'banned_username' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'telegram_bot_token' => 'Lorem ipsum dolor sit amet',
                'telegram_chatid' => 'Lorem ipsum dolor sit amet',
                'hcaptcha_sitekey' => 'Lorem ipsum dolor sit amet',
                'hcaptcha_secretkey' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-09-30 08:21:17',
                'modified' => '2022-09-30 08:21:17',
            ],
        ];
        parent::init();
    }
}
