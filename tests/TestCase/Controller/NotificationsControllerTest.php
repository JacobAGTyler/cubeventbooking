<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\NotificationsController Test Case
 */
class NotificationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notifications',
        'app.auth_roles',
        'app.notification_types',
        'app.districts',
        'app.roles',
        'app.users',
        'app.scoutgroups',
        'app.sections',
        'app.section_types',
        'app.password_states',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/notifications');

        $this->assertResponseOk();
    }

    /**
     * Test unread method
     *
     * @return void
     */
    public function testUnread()
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
     * Test welcome method
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validate method
     *
     * @return void
     */
    public function testValidate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test new_logistic method
     *
     * @return void
     */
    public function testNewLogistic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test new_reset method
     *
     * @return void
     */
    public function testNewReset()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
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

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getMailer method
     *
     * @return void
     */
    public function testGetMailer()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
