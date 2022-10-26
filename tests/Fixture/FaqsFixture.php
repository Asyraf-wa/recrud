<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FaqsFixture
 */
class FaqsFixture extends TestFixture
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
                'id' => '6e048c47-afad-42b2-a467-0be650e0056f',
                'category' => 'Lorem ipsum dolor sit amet',
                'question' => 'Lorem ipsum dolor sit amet',
                'answer' => 'Lorem ipsum dolor sit amet',
                'slug' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2022-10-21 13:57:56',
                'modified' => '2022-10-21 13:57:56',
            ],
        ];
        parent::init();
    }
}
