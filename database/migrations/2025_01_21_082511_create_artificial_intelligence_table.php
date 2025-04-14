<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artificial_intelligence', function (Blueprint $table) {
            $table->id();
            $table->string('chat_gpt_key')->nullable()->default('insira_aqui_a_chave_de_projeto');
            $table->string('model')->nullable();
            $table->string('admin_chatgpt_key')->nullable()->default('insira_aqui_a_chave_de_admin');
            $table->timestamps();
        });

        DB::table('artificial_intelligence')->insert([
            'chat_gpt_key' => 'insira_aqui_a_chave_de_projeto',
            'admin_chatgpt_key' => 'insira_aqui_a_chave_de_admin',
            'model' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artificial_intelligence');
    }
};
