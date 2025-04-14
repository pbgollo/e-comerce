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
        Schema::create('admin_appearance', function (Blueprint $table) {
            $table->id();
            $table->string('login_primary_color');
            $table->string('login_secondary_color');
            $table->image('login_logo');
            $table->image('menu_logo');
            $table->image('dashboard_image');
            $table->string('background_color_page');
            $table->string('btn_color_save');
            $table->string('btn_color_view');
            $table->string('btn_color_delete');
            $table->string('checkbox_color');
            $table->timestamps();
        });

        DB::table('admin_appearance')->insert(
            [
                'login_primary_color' => '#9700F6',
                'login_secondary_color' => '#825ee4',
                'login_logo' => 'logo-nomad.png',
                'menu_logo' => 'logo.png',
                'dashboard_image' => 'banner.jpg',
                'background_color_page' => '#9700F6',
                'btn_color_save' => '#2dce89',
                'btn_color_view' => '#9700F6',
                'btn_color_delete' => '#f5365c',
                'checkbox_color' => '#9700F6',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_appearance');
    }
};
