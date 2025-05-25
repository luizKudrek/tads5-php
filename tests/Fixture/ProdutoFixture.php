<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProdutoFixture
 */
class ProdutoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'produto';
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
                'created' => '2025-04-08 18:28:34',
                'modified' => '2025-04-08 18:28:34',
            ],
        ];
        parent::init();
    }
}
