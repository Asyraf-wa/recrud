<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserGroupsTable Test Case
 */
class UserGroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserGroupsTable
     */
    protected $UserGroups;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UserGroups',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserGroups') ? [] : ['className' => UserGroupsTable::class];
        $this->UserGroups = $this->getTableLocator()->get('UserGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UserGroups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserGroupsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
