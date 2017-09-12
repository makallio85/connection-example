<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnimalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnimalsTable Test Case
 */
class AnimalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnimalsTable
     */
    public $Animals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.animals',
        'app.dogs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Animals') ? [] : ['className' => AnimalsTable::class];
        $this->Animals = TableRegistry::get('Animals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Animals);

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
}
