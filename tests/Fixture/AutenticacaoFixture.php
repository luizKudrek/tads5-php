<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AutenticacaoFixture
 */
class AutenticacaoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'autenticacao';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'cpf' => 'Lorem ipsum ',
                'autenticacao' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-08 18:27:54',
                'modified' => '2025-04-08 18:27:54',
            ],
        ];
        parent::init();
    }
}
