<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property \App\Model\Table\MenusTable&\Cake\ORM\Association\BelongsTo $ParentMenus
 * @property \App\Model\Table\MenusTable&\Cake\ORM\Association\HasMany $ChildMenus
 *
 * @method \App\Model\Entity\Menu newEmptyEntity()
 * @method \App\Model\Entity\Menu newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \App\Model\Entity\Menu findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Menu[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Menu|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Menu saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class MenusTable extends Table
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

        $this->setTable('menus');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Tree', [
            'level' => 'level', // Defaults to null, i.e. no level saving
        ]);

        $this->belongsTo('ParentMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id',
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
        /* $validator
            ->integer('parent_id')
            ->allowEmptyString('parent_id');

        $validator
            ->integer('level')
            ->notEmptyString('level'); */

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        /* $validator
            ->scalar('url')
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmptyString('active');

        $validator
            ->boolean('disabled')
            ->requirePresence('disabled', 'create')
            ->notEmptyString('disabled');

        $validator
            ->boolean('divider_before')
            ->notEmptyString('divider_before'); */

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
        $rules->add($rules->existsIn('parent_id', 'ParentMenus'), ['errorField' => 'parent_id']);

        return $rules;
    }
}
