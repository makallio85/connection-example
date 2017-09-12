<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DogsTable Test Case
 */
class DogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DogsTable
     */
    public $Dogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dogs',
        'app.animals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dogs') ? [] : ['className' => DogsTable::class];
        $this->Dogs = TableRegistry::get('Dogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dogs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
