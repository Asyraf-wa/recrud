<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlaygroundsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlaygroundsTable Test Case
 */
class PlaygroundsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlaygroundsTable
     */
    protected $Playgrounds;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Playgrounds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Playgrounds') ? [] : ['className' => PlaygroundsTable::class];
        $this->Playgrounds = $this->getTableLocator()->get('Playgrounds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Playgrounds);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlaygroundsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
