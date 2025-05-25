<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Autenticacao Model
 *
 * @method \App\Model\Entity\Autenticacao newEmptyEntity()
 * @method \App\Model\Entity\Autenticacao newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Autenticacao> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Autenticacao get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Autenticacao findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Autenticacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Autenticacao> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Autenticacao|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Autenticacao saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Autenticacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Autenticacao>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Autenticacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Autenticacao> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Autenticacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Autenticacao>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Autenticacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Autenticacao> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AutenticacaoTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('autenticacao');
        $this->setDisplayField('cpf');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 14)
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf');

        $validator
            ->scalar('autenticacao')
            ->maxLength('autenticacao', 152)
            ->requirePresence('autenticacao', 'create')
            ->notEmptyString('autenticacao');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->allowEmptyString('ativo');

        return $validator;
    }
}
