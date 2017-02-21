<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PasswordStates Model
 *
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\PasswordState get($primaryKey, $options = [])
 * @method \App\Model\Entity\PasswordState newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PasswordState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PasswordState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PasswordState findOrCreate($search, callable $callback = null, $options = [])
 */
class PasswordStatesTable extends Table
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

        $this->table('password_states');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'password_state_id'
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
            ->requirePresence('password_state', 'create')
            ->notEmpty('password_state');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('expired')
            ->requirePresence('expired', 'create')
            ->notEmpty('expired');

        return $validator;
    }
}