<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlaygroundsFixture
 */
class PlaygroundsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2023-02-19 16:38:24',
                'modified' => '2023-02-19 16:38:24',
                'deleted' => '2023-02-19 16:38:24',
            ],
        ];
        parent::init();
    }
}
