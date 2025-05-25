<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AutenticacaoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AutenticacaoTable Test Case
 */
class AutenticacaoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AutenticacaoTable
     */
    protected $Autenticacao;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Autenticacao',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Autenticacao') ? [] : ['className' => AutenticacaoTable::class];
        $this->Autenticacao = $this->getTableLocator()->get('Autenticacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Autenticacao);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AutenticacaoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
