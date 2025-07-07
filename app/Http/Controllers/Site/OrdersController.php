<?php

namespace App\Http\Controllers\Site;

use App\Models\OrderModel;
use App\Models\AppUserModel;


class OrdersController extends Controller
{

    public function admin()
    {
        return view("site.pages.admin-orders", $this->vm);
    }

    public function cart()
    {
        return view("site.pages.checkout", $this->vm);
    }
}
