<?php
namespace App\Test\TestCase\Controller\Champion;

use App\Controller\ChampionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ChampionsController Test Case
 */
class ChampionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.champions',
        'app.districts',
        'app.scoutgroups',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
