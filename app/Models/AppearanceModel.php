<?php

namespace App\Models;

class AppearanceModel extends BaseModel
{
    protected $table = 'admin_appearance';

    protected $fillable = [
        'login_primary_color',
        'login_secondary_color',
        'login_logo',
        'menu_logo',
        'dashboard_image',
        'background_color_page',
        'btn_color_save',
        'btn_color_upload',
        'btn_color_view',
        'btn_color_delete',
        'checkbox_color',
    ];

}
