<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VeiculosFixture
 */
class VeiculosFixture extends TestFixture
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
                'modelo' => 'Lorem ipsum dolor sit amet',
                'ano' => 1,
                'placa' => 'Lorem ',
                'ativo' => 'L',
                'created' => '2025-04-22 21:21:27',
                'modified' => '2025-04-22 21:21:27',
                'fabricante_id' => 1,
                'tipo_id' => 1,
            ],
        ];
        parent::init();
    }
}
