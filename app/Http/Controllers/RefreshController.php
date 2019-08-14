<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class RefreshController extends Controller
{
    public function index()
    { }

    public function FirstChart()
    {
        $DataChart = DB::table('qrcode')->select([
            // This aggregates the data and makes available a 'count' attribute
            DB::raw('DATE_FORMAT(created_at, "%d") as day'),
            // This throws away the timestamp portion of the date
            DB::raw('count(id) as `count`')
            // Group these records according to that day
        ])->groupBy('day')
            // And restrict these results to only those created in the last week
            ->where('created_at', '>=', Carbon::now()->subdays(7))
            ->get();


        return response()->json($DataChart);
    }
    public function ThirdChart()
    {
        $amMidnight = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 00:00:00');
        $amThree = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 03:00:00');
        $amSix = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 06:00:00');
        $amNine = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 09:00:00');
        //same here
        $pmNoon = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 12:00:00');
        $pmThree = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 15:00:00');
        $pmSix = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 18:00:00');
        $pmNine = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 21:00:00');
        $pmMidnight = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::yesterday()->toDateString() . ' 23:59:59');

        $json = ([
            $amMidnightToThree = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$amMidnight, $amThree])
                ->count(),
            $amThreeToSix = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$amThree, $amSix])
                ->count(),
            $amSixToNine = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$amSix, $amNine])
                ->count(),
            $amNineToPmNoon = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$amNine, $pmNoon])
                ->count(),
            //AICI SE SCHIMBA ziua
            $pmNoonToThree = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$pmNoon, $pmThree])
                ->count(),
            $pmThreeToSix = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$pmThree, $pmSix])
                ->count(),
            $pmSixToNine = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$pmSix, $pmNine])
                ->count(),
            $pmNinetoAmMidnight = DB::table("qrcode")->select('sent_at')
                ->whereBetween('sent_at', [$pmNine, $pmMidnight])
                ->count()
        ]);
        return response()->json($json);
    }
}
