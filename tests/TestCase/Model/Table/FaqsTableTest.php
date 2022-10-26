<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FaqsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FaqsTable Test Case
 */
class FaqsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FaqsTable
     */
    protected $Faqs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Faqs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Faqs') ? [] : ['className' => FaqsTable::class];
        $this->Faqs = $this->getTableLocator()->get('Faqs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Faqs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FaqsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
