<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AutenticacaosFixture
 */
class AutenticacaosFixture extends TestFixture
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
                'autenticacao' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-15 22:18:58',
                'modified' => '2025-04-15 22:18:58',
                'user_id' => 1,
                'expira' => '2025-04-15',
            ],
        ];
        parent::init();
    }
}
