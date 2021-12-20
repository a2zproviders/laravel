<?php

namespace App\Http\Controllers\admin;

use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Model\Order;
use App\Model\Setting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect(url('admin'));
        } else {
            $page = 'dashboard';
            $title = 'Master Admin Dashboard';
            $setting = Setting::find(1);
            if (Auth::user()->role_id == 1) {
                $user  = User::where('role_id', 2)->count();
                $orders  = Order::count();

                $data = compact('page', 'title',   'user', 'orders',  'setting');
            } else {
                $orders  = Order::with('user')->where('user_id', Auth::user()->id)->count();

                $data = compact('page', 'title',  'orders', 'setting');
            }

            return view('admin.layout', $data);
        }
    }
}
