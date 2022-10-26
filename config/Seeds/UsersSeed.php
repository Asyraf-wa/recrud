<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'user_group_id' => '1',
                'fullname' => 'Administrator',
                'password' => '$2y$10$Qm2Vt57wD8syN8r41w3WOeGNN09pVsqu642J0IcRnMdtFxkPwIE6S',
                'email' => 'admin@recrud.com',
                'avatar' => 'llama-6782140_960_720.jpg',
                'avatar_dir' => 'webroot\\files\\Users\\avatar\\Administrator',
                'token' => NULL,
                'status' => '1',
                'is_email_verified' => '1',
                'last_login' => NULL,
                'ip_address' => '192.168.0.1',
                'slug' => 'Administrator',
                'created' => '2022-10-26 02:54:19',
                'modified' => '2022-10-26 02:54:19',
                'created_by' => NULL,
                'modified_by' => NULL,
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
