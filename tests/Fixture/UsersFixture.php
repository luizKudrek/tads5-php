<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'nome' => 'Lorem ipsum dolor sit amet',
                'cpf' => 'Lorem ipsum ',
                'password' => 'Lorem ipsum dolor sit amet',
                'celular' => 'Lorem ipsum d',
                'dtnasc' => '2025-04-29',
                'email' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-29 20:21:53',
                'modified' => '2025-04-29 20:21:53',
            ],
        ];
        parent::init();
    }
}
