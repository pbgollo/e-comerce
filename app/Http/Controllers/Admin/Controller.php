<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppearanceModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $vm = [];

    function __construct(){

        //APPEARANCE
        $this->vm['appearance'] = AppearanceModel::first()->toArray();
    }
}
