<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManutencaosFixture
 */
class ManutencaosFixture extends TestFixture
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
                'valor' => 1.5,
                'data' => '2025-04-22',
                'numntfiscal' => 1,
                'ativo' => 'L',
                'created' => '2025-04-22 21:50:25',
                'modified' => '2025-04-22 21:50:25',
                'fornecedor_id' => 1,
                'veiculo_id' => 1,
            ],
        ];
        parent::init();
    }
}
