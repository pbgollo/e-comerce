<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ListDatabaseTables extends Command
{
    protected $signature = 'db:list-tables';
    protected $description = 'Lista todas as tabelas do banco de dados e suas colunas';

    public function handle()
    {
        $this->info("Listando tabelas e colunas do banco de dados...\n");

        $tables = DB::select('SHOW TABLES');
        $database = DB::getDatabaseName();
        $keyName = "Tables_in_{$database}";

        foreach ($tables as $table) {
            $tableName = $table->$keyName;
            $this->info("📁 Tabela: $tableName");

            $columns = Schema::getColumnListing($tableName);

            foreach ($columns as $column) {
                $this->line("   - $column");
            }

            $this->line(""); // quebra de linha entre tabelas
        }

        return Command::SUCCESS;
    }
}
