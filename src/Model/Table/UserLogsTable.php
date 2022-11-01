<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserLogs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserLog newEmptyEntity()
 * @method \App\Model\Entity\UserLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('user_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
		$this->addBehavior('Search.Search');
		//$this->addBehavior('AuditStash.AuditLog');

		$this->searchManager()
			->value('id')
			->value('status')
			->add('search', 'Search.Like', [
				'before' => true,
				'after' => true,
				'fieldMode' => 'OR',
				'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
				'fields' => ['id','status'],
			]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
/*
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('action')
            ->maxLength('action', 255)
            ->allowEmptyString('action');

        $validator
            ->scalar('useragent')
            ->maxLength('useragent', 256)
            ->allowEmptyString('useragent');

        $validator
            ->scalar('user_browser')
            ->maxLength('user_browser', 255)
            ->allowEmptyString('user_browser');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 50)
            ->allowEmptyString('ip');

*/
        return $validator;
    }
    /**
     * Appraisal validation rules.
     */
    public function validationAppraisal($validator)
    {
		$validator	
		->add('confirm', 'notEmpty', [
					'rule' => function ($value, $context) {
						return !empty($value);
					},
					'message' => __('Please select checkbox to continue.'),
					//'provider' => 'table',
					'requirePresence' => true,
					'allowEmpty' => false,
					'last' => true,
				]);
			
        return $validator;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
