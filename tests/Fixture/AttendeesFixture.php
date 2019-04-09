<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendeesFixture
 */
class AttendeesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'role_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'firstname' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'lastname' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'dateofbirth' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'phone' => ['type' => 'string', 'length' => 12, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'phone2' => ['type' => 'string', 'length' => 12, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'address_1' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'address_2' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'county' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'postcode' => ['type' => 'string', 'length' => 8, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'nightsawaypermit' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'vegetarian' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'osm_generated' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'osm_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_sync_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'user_attendee' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'section_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_apps' => ['type' => 'integer', 'length' => 10, 'default' => '0', 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'identity_hash' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'obfuscated' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'attendees_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'attendees_role_id' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
            'attendees_section_id' => ['type' => 'index', 'columns' => ['section_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'attendees_identity_hash' => ['type' => 'unique', 'columns' => ['identity_hash'], 'length' => []],
            'attendees_role_id' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'attendees_section_id' => ['type' => 'foreign', 'columns' => ['section_id'], 'references' => ['sections', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'attendees_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 1,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => true,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joan',
                'lastname' => 'Arc',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => false,
                'osm_id' => null,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joy',
                'lastname' => 'Lazz',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 3,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Goat',
                'lastname' => 'Fish',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 4,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Monkey',
                'lastname' => 'Nuts',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Julius',
                'lastname' => 'Cesar',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 6,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Brutus',
                'lastname' => 'Blob',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 7,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Joel',
                'lastname' => 'Plinky',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 8,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'King',
                'lastname' => 'Wensuslas',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Queen',
                'lastname' => 'Lizzy Face',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 10,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Llama',
                'lastname' => 'Fish Town',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 0,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 11,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Octoptus',
                'lastname' => 'Octocorn',
                'dateofbirth' => date_create('2016-12-26 00:00:00'),
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => 1,
                'vegetarian' => 1,
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'osm_generated' => true,
                'osm_id' => 12,
                'osm_sync_date' => date_create('2016-12-26 23:22:30'),
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
        ];
        parent::init();
    }
}
