<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateAutenticacao extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('autenticacaos');
        $table->addColumn('autenticacao', 'string', [
            'default' => null,
            'limit' => 152,
            'null' => false,
        ]);
        $table->addColumn('ativo', 'string', [
            'default' => "S",
            'limit' => 1,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->create();
    }
}
