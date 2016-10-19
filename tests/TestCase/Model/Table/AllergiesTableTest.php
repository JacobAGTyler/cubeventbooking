<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllergiesTable Test Case
 */
class AllergiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AllergiesTable
     */
    public $Allergies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allergies',
        'app.attendees',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.invoices',
        'app.invoice_items',
        'app.itemtypes',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.applications_attendees',
        'app.notifications',
        'app.notificationtypes',
        'app.attendees_allergies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Allergies') ? [] : ['className' => 'App\Model\Table\AllergiesTable'];
        $this->Allergies = TableRegistry::get('Allergies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Allergies);

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
