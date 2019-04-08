<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TokensTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;

/**
 * App\Model\Table\TokensTable Test Case
 */
class TokensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TokensTable
     */
    public $Tokens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tokens',
        'app.email_sends',
        'app.notifications',
        'app.notification_types',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.password_states',
        'app.districts',
        'app.champions',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.settings',
        'app.setting_types',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Tokens') ? [] : ['className' => TokensTable::class];
        $this->Tokens = TableRegistry::getTableLocator()->get('Tokens', $config);

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tokens);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->Tokens->get(1)->toArray();

        $dates = [
            'expires',
            'created',
            'modified',
            'utilised',
            'deleted',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'random_number' => 1789,
            'header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                    1
                ],
                'authenticate' => true,
            ]
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Tokens->find('all')->count();
        $this->assertEquals(1, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $startNow = Time::now();

        $badData = [
            'id' => 6,
            'token' => 'Lorem ipsum dolor sit',
            'user_id' => null,
            'email_send_id' => null,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 1,
            'header' => 'Lorem ipsum dolor amet'
        ];

        $goodData = [
            'token' => 'Lorem ipsum dolor sit',
            'user_id' => 1,
            'email_send_id' => 1,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk sit amet'
        ];

        $expected = [
            [
                'id' => 1,
                'token' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => $startNow,
                'active' => 1,
                'deleted' => null,
                'hash' => 'Lorem ipsum dolor sit amet',
                'header' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 3,
                'token' => 'Lorem ipsum dolor sit',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => null,
                'active' => true,
                'deleted' => null,
                'hash' => 'Lorem dolor sit amet',
                'header' => 'Lorem ipsum sk sit amet'
            ],
        ];

        $badEntity = $this->Tokens->newEntity($badData);
        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Tokens->save($badEntity));
        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->find('all', [
            'fields' => [
                'id',
                'token',
                'user_id',
                'email_send_id',
                'created',
                'modified',
                'utilised',
                'active',
                'deleted',
                'hash',
                'header',
            ]
        ]);

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $startNow = Time::now();

        $badData = [
            'id' => 8,
            'token' => 'Lorem dolor sit',
            'user_id' => 109,
            'email_send_id' => 109,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit amet',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk sit amet'
        ];

        $goodData = [
            'id' => 9,
            'token' => 'Lorem sit',
            'user_id' => 1,
            'email_send_id' => 1,
            'created' => $startNow,
            'modified' => $startNow,
            'deleted' => null,
            'hash' => 'Lorem dolor sit',
            'random_number' => 12,
            'header' => 'Lorem ipsum sk amet'
        ];

        $expected = [
            [
                'id' => 1,
                'token' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => $startNow,
                'active' => 1,
                'deleted' => null,
                'hash' => 'Lorem ipsum dolor sit amet',
                'header' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 9,
                'token' => 'Lorem sit',
                'user_id' => 1,
                'email_send_id' => 1,
                'created' => $startNow,
                'modified' => $startNow,
                'utilised' => null,
                'active' => true,
                'deleted' => null,
                'hash' => 'Lorem dolor sit',
                'header' => 'Lorem ipsum sk amet'
            ],
        ];

        $badEntity = $this->Tokens->newEntity($badData);
        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Tokens->save($badEntity));
        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->find('all', [
            'fields' => [
                'id',
                'token',
                'user_id',
                'email_send_id',
                'created',
                'modified',
                'utilised',
                'active',
                'deleted',
                'hash',
                'header',
            ]
        ]);

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the Build Token
     */
    public function testBuildToken()
    {
        $token = $this->Tokens->buildToken(1);
        $token = urldecode($token);
        //$token = gzuncompress($token);

        $this->assertGreaterThanOrEqual(32, strlen($token), 'Token is too short.');

        $decrypter = substr($token, 0, 8);
        $this->assertEquals(8, strlen($decrypter));

        $token = substr($token, 8);

        $token = base64_decode($token);
        $token = json_decode($token);

        $data = [
            'id' => 1,
            'random_number' => 1789,
        ];

        $this->assertEquals($data['id'], $token->id);

        $this->assertEquals($data['random_number'], $token->random_number);
        $this->assertTrue(is_numeric($token->random_number));
    }

    public function testBeforeSave()
    {
        $goodData = [
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $expected = [
            'id' => 3,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $goodEntity = $this->Tokens->newEntity($goodData);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'id',
                'user_id',
                'email_send_id',
                'active',
                'header',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'random_number',
                'active'
            ]
        ]);

        $result = $query->toArray();

        $this->assertTrue(is_numeric($result['random_number']));
        $this->assertTrue($result['active']);
    }

    public function testValidateToken()
    {
        $goodData = [
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
            'token' => 'GOAT',
            'header' => [
                'redirect' => [
                    'controller' => 'Applications',
                    'action' => 'view',
                    'prefix' => false,
                ],
                'authenticate' => true,
            ]
        ];

        $expected = [
            'id' => 3,
            'user_id' => 1,
            'email_send_id' => 1,
            'active' => true,
        ];

        $goodEntity = $this->Tokens->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->Tokens->save($goodEntity);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'id',
                'user_id',
                'email_send_id',
                'active',
            ]
        ]);

        $result = $query->toArray();

        $this->assertEquals($expected, $result);

        $query = $this->Tokens->get(3, [
            'fields' => [
                'random_number',
                'active'
            ]
        ]);

        $result = $query->toArray();

        $this->assertTrue(is_numeric($result['random_number']));
        $this->assertTrue($result['active']);

        $token = $this->Tokens->buildToken(3);

        $result = $this->Tokens->validateToken($token);

        $this->assertNotFalse($result);
        $this->assertTrue(is_numeric($result));

        $incorrectToken = substr($token, 25, 256);

        $result = $this->Tokens->validateToken($incorrectToken);

        $this->assertFalse($result);
        $this->assertNotTrue(is_numeric($result));
    }
}
