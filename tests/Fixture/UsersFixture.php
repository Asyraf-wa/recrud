<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'id' => 1,
                'user_group_id' => 1,
                'fullname' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor ',
                'password' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'avatar' => 'Lorem ipsum dolor sit amet',
                'avatar_dir' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'status' => 'L',
                'is_email_verified' => 1,
                'last_login' => '2022-09-30 04:40:48',
                'ip_address' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-09-30 04:40:48',
                'modified' => '2022-09-30 04:40:48',
                'created_by' => 1,
                'modified_by' => 1,
            ],
        ];
        parent::init();
    }
}
