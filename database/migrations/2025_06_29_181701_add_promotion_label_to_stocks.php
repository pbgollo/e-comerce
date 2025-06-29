<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('promotion_label')->nullable();
            $table->integer('promotion_percentage')->nullable();
            $table->double('promotion_price', 10, 2)->nullable();
            $table->integer('promotion_active')->default(1);
            $table->string('benefit_label')->nullable();
            $table->integer('benefit_active')->default(1);
            $table->string('payment_methods')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn([
                'promotion_label',
                'promotion_percentage',
                'promotion_price',
                'promotion_active',
                'benefit_label',
                'benefit_active',
                'payment_methods',
            ]);
        });
    }

};
