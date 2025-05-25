<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FornecedorsFixture
 */
class FornecedorsFixture extends TestFixture
{
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
                'cnpj' => 'Lorem ipsum dolo',
                'nome' => 'Lorem ipsum dolor sit amet',
                'telefone' => 'Lorem ipsum d',
                'email' => 'Lorem ipsum dolor sit amet',
                'logradouro' => 'Lorem ipsum dolor sit amet',
                'numero' => 'Lorem ipsum dolor ',
                'bairro' => 'Lorem ipsum dolor ',
                'complemento' => 'Lorem ipsum dolor sit amet',
                'cidade' => 'Lorem ipsum dolor sit amet',
                'estado' => 'Lo',
                'cep' => 'Lorem ip',
                'ativo' => 'L',
                'created' => '2025-04-22 21:20:59',
                'modified' => '2025-04-22 21:20:59',
                'servico_id' => 1,
            ],
        ];
        parent::init();
    }
}
