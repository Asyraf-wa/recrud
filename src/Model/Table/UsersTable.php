<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\UserGroupsTable&\Cake\ORM\Association\BelongsTo $UserGroups
 * @property \App\Model\Table\ContactsTable&\Cake\ORM\Association\HasMany $Contacts
 * @property \App\Model\Table\UserLogsTable&\Cake\ORM\Association\HasMany $UserLogs
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Tools.Slugged',
			['label' => 'fullname', 'unique' => true, 'mode' => 'ascii', 'field' => 'slug']
		);
		
		$this->addBehavior('AuditStash.AuditLog');
		
		$this->addBehavior('Josegonzalez/Upload.Upload', [
			'avatar' => [
				'fields' => [
					'dir' => 'avatar_dir', // defaults to `dir`
					//'size' => 'photo_size', // defaults to `size`
					//'type' => 'photo_type', // defaults to `type`
				],
			'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:slug}',
			],
		]);
		
		$this->addBehavior('Search.Search');
		
		/* $this->searchManager()
			->value('user_group_id')
				->add('search', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['user_group_id'],
				]); */
				
		$this->searchManager()
			->value('fullname')
			->value('email')
			->value('status')
			->value('is_email_verified')
			->add('status', 'Search.Like', [
					'before' => true,
					'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '',
					'comparison' => 'LIKE',
					'fields' => ['status'],
				])
			/* ->add('search', 'Search.Like', [
					//'before' => true,
					//'after' => true,
					'fieldMode' => 'OR',
					'multiValue' => true,
					'multiValueSeparator' => '|',
					'comparison' => 'LIKE',
					'wildcardAny' => '*',
					'wildcardOne' => '?',
					'fields' => ['status'],
				]) */
			->add('register_from', 'Search.Compare', [
				'fields' => [$this->aliasField('created')],
				'operator' => '>='
			])
			->add('register_to', 'Search.Compare', [
				'fields' => [$this->aliasField('created')],
				'operator' => '<='
			])
				->callback('user_group_id', [
					'callback' => function (\Cake\ORM\Query $query, array $args,  \Search\Model\Filter\Base $filter) {
						$query
							->innerJoinWith('UserGroups', function (\Cake\ORM\Query $query) use ($args) {
								return $query->where(['UserGroups.id IN' => $args['user_group_id']]);
							})
							->group('Users.id');

						return true;
					}
				]);
				
			
				
				
		/* $this->searchManager()
            ->like('search', ['fields' => ['user_group_id'], 'multiValue' => true, 'multiValueSeparator' => '|']); */
		
		/* $this->searchManager()
			->value('fullname')
			->value('email')
			->value('user_group_id')
			->value('status')
			->add('search', 'Search.Like', [
				'before' => true,
				'after' => true,
				'fieldMode' => 'OR',
				'comparison' => 'LIKE',
				'wildcardAny' => '*',
				'wildcardOne' => '?',
				'fields' => ['fullname'],
			])
			//->add('publish_on', 'Search.Compare', [
			//	'fields' => [$this->aliasField('publish_on')],
			//	'operator' => '>='
			//])
			->add('publish_from', 'Search.Compare', [
				'fields' => [$this->aliasField('publish_on')],
				'operator' => '>='
			])
			->add('publish_to', 'Search.Compare', [
				'fields' => [$this->aliasField('publish_on')],
				'operator' => '<='
			]); */

        $this->belongsTo('UserGroups', [
            'foreignKey' => 'user_group_id',
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserLogs', [
            'foreignKey' => 'user_id',
        ]);
    }
	
	public function validationPassword($validator) {
		$validator
			->add('current_password', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter old password'),
					'last'=>true
				],
			])
			
			->add('current_password',
				'custom',[
					'rule'=>  function($value, $context){
						$user = $this->get($context['data']['id']);
							if ($user) {
								if ((new DefaultPasswordHasher)->check($value, $user->password)) {
									return true;
								}
							}
						return false;
					},
					'message'=>'The old password does not match the current password!',
			])


			->add('password', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter password'),
					'last'=>true
				],
				'mustBeLonger'=>[
					'rule'=>['minLength', 6],
					'message'=>__('Password must be greater than 5 characters'),
					'last'=>true
				]
			])

			->add('cpassword', [
				'notBlank'=>[
					'rule'=>'notBlank',
					'message'=>__('Please enter password'),
					'last'=>true
				],
				'mustMatch'=>[
					'rule'=>'checkForSamePassword',
					'provider'=>'table',
					'message'=>__('Both password must match')
				]
			]);

		return $validator;
	}

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        /* $validator
            ->integer('user_group_id')
            ->allowEmptyString('user_group_id');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->scalar('username')
            ->maxLength('username', 20)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('avatar')
            ->maxLength('avatar', 255)
            ->allowEmptyString('avatar');

        $validator
            ->scalar('avatar_dir')
            ->maxLength('avatar_dir', 255)
            ->allowEmptyString('avatar_dir');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->scalar('status')
            ->maxLength('status', 1)
            ->notEmptyString('status');

        $validator
            ->integer('is_email_verified')
            ->notEmptyString('is_email_verified');

        $validator
            ->dateTime('last_login')
            ->allowEmptyDateTime('last_login');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 255)
            ->allowEmptyString('ip_address');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by'); */

        return $validator;
    }
	
	public function validationRegister($validator)
    {
        $validator
            ->scalar('fullname')
			->minLength('fullname', 5, 'Minimum length is 5')
            ->requirePresence('fullname')
            ->notEmptyString('fullname','Fullname is required');
			
        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password')
            ->notEmptyString('password','Password is required')
			->add('cpassword', [
				'compare' => [
					'rule' => ['compareWith', 'password'],
					'message' => 'Password not match'
				]
			]);

		$validator
            ->email('email')
            ->requirePresence('email')
            ->notEmptyString('email','Email is required');
			
		$validator
            ->allowEmpty('avatar')
            ->add('avatar', [
                'validExtension' => [
                    'rule' => ['extension',['jpg','jpeg']], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('Only these files extension are allowed: .jpg / .jpeg')
                ]
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
	 
	public function checkForSamePassword($value, $context) {
		if(!empty($value) && $value != $context['data']['password']) {
			return false;
		}
		return true;
	}
	
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->existsIn('user_group_id', 'UserGroups'), ['errorField' => 'user_group_id']);

        return $rules;
    }
}
