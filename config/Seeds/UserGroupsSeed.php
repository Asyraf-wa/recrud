<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * UserGroups seed.
 */
class UserGroupsSeed extends AbstractSeed
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
    public function run(): void
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Admin',
                'description' => 'Admninistrator',
                'created' => '2021-01-23 13:21:29',
                'modified' => '2021-01-23 13:21:29',
            ],
            [
                'id' => '2',
                'name' => 'Mod',
                'description' => 'Moderator',
                'created' => '2021-01-23 13:21:29',
                'modified' => '2021-01-23 13:21:29',
            ],
            [
                'id' => '3',
                'name' => 'User',
                'description' => 'Normal User',
                'created' => '2021-01-23 13:21:29',
                'modified' => '2021-01-23 13:21:29',
            ],
        ];

        $table = $this->table('user_groups');
        $table->insert($data)->save();
    }
}
