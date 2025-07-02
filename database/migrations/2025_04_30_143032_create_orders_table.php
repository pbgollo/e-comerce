<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('data_pedido')->nullable();
            $table->date('data_envio')->nullable();
            $table->date('data_cancelamento')->nullable();
            $table->enum('situacao', ['novo', 'enviado', 'cancelado'])->nullable();
            $table->foreignId('app_user_id')->constrained('app_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
