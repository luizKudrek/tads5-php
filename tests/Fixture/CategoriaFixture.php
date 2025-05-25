<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CategoriaFixture
 */
class CategoriaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'categoria';
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
                'tipo' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-08 18:28:08',
                'modified' => '2025-04-08 18:28:08',
            ],
        ];
        parent::init();
    }
}
