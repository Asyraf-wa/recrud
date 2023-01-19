<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Faqs seed.
 */
class FaqsSeed extends AbstractSeed
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
                'category' => 'General',
                'question' => 'General Questions 1',
                'answer' => 'General Answer 1',
                'slug' => 'General-Questions-1',
                'status' => '1',
                'created' => '2022-11-13 15:41:26',
                'modified' => '2022-11-13 16:31:14',
            ],
            [
                'id' => '2',
                'category' => 'Account',
                'question' => 'Account Questions 1',
                'answer' => 'Account Answer 1',
                'slug' => 'Account-Questions-1',
                'status' => '1',
                'created' => '2022-11-13 15:43:15',
                'modified' => '2022-11-13 15:43:15',
            ],
            [
                'id' => '3',
                'category' => 'Other',
                'question' => 'Other Questions 1',
                'answer' => 'Other Answer 1',
                'slug' => 'Other-Questions-1',
                'status' => '1',
                'created' => '2022-11-13 15:43:34',
                'modified' => '2022-11-13 15:43:34',
            ],
            [
                'id' => '6',
                'category' => 'General',
                'question' => 'General Questions 2',
                'answer' => 'General Answer 2',
                'slug' => 'General-Questions-2',
                'status' => '1',
                'created' => '2022-11-13 16:54:25',
                'modified' => '2022-11-13 16:54:25',
            ],
        ];

        $table = $this->table('faqs');
        $table->insert($data)->save();
    }
}
