<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProdutosFixture
 */
class ProdutosFixture extends TestFixture
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
                'produto' => 'Lorem ipsum dolor sit amet',
                'id_categoria' => 1,
                'ativo' => 'L',
                'created' => '2025-04-08 19:32:16',
                'modified' => '2025-04-08 19:32:16',
            ],
        ];
        parent::init();
    }
}
