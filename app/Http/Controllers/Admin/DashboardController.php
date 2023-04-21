<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenueEachMonth = [];
        $revenueToday =  Order::whereDate('created_at', Carbon::today())->sum('total');
        $revenueMonth =  DB::select("SELECT SUM(total) total FROM orders WHERE status = 3 
        AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(created_at), YEAR(created_at)");
        $revenueYear =  DB::select("SELECT SUM(total) total FROM orders WHERE status = 3 
        AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY YEAR(created_at)");
        $revenueEachMonthCollection = DB::select("SELECT SUM(total) total, MONTH(created_at) month FROM orders WHERE status = 3 
        AND YEAR(created_at) = YEAR(CURRENT_DATE())
        GROUP BY MONTH(created_at), YEAR(created_at)");
        $revenueEachMonthCollection = array_map(function ($value) {
            return [
                'total' => $value->total,
                'month' => $value->month
            ];
        }, $revenueEachMonthCollection);
        foreach ($revenueEachMonthCollection as $row) {
            $revenueEachMonth[] = $row;
        }
        $countUser = User::count();

        return view('admin.dashboard.index', compact('revenueToday', 'revenueMonth', 'revenueYear', 'countUser', 'revenueEachMonth'));
    }
}
