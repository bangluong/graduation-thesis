<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $today = date('Y-m-d');
        $nextDay = date('Y-m-d',strtotime(' +1 day'));
        $preDay = date('Y-m-d',strtotime(' -1 day'));
        $todayOrderQuery = Orders::query()->where('created_at', '<', $nextDay)
            ->where('created_at', '>', $today);
        $preDayOrdersQuery = Orders::query()->where('created_at', '<', $today)
            ->where('created_at', '>', $preDay);
        $preDayTotal = $preDayOrdersQuery->sum('subtotal');
        $todayTotal = $todayOrderQuery->sum('subtotal');
        if ($todayTotal > $preDayTotal) {
            $percent = '+ '. ($todayTotal - $preDayTotal) / $preDayTotal;
        } elseif ($todayTotal != 0) {
            $percent = '- '. ($todayTotal - $preDayTotal) / $preDayTotal;
        } else {
            $percent = '+ 0';
        }
        return view('admin.dashboard')->with([
            'today_amount' => $todayTotal,
            'today_percent' =>  $percent
        ]);
    }
}
