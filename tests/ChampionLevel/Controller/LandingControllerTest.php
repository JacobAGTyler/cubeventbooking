<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LandingController Test Case
 */
class LandingControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
    *

    public $fixtures = [
    'app.settings',
    'app.districts',
    'app.scoutgroups',
    'app.roles',
    'app.users'
    ];*/

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testUserHome()
    {
        $this->markTestSkipped('Fixture Issue');

        $this->session(['Auth.User.id' => 1]);

        $this->get('/landing/user-home');

        $this->assertResponseOk();
    }

    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/landing/user-home');
    
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test welcome method
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->get('/');

        $this->assertResponseOk();
    }
}