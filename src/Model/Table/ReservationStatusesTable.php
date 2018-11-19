<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReservationStatuses Model
 *
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\HasMany $Reservations
 *
 * @method \App\Model\Entity\ReservationStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReservationStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReservationStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationStatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservationStatusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('reservation_statuses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Reservations', [
            'foreignKey' => 'reservation_status_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('reservation_status')
            ->maxLength('reservation_status', 255)
            ->requirePresence('reservation_status', 'create')
            ->notEmpty('reservation_status');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('complete')
            ->requirePresence('complete', 'create')
            ->notEmpty('complete');

        return $validator;
    }
}