<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QrCodeCore;
use DB;
use Carbon\Carbon;

class DashBoardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {

        $QrCodeRequest = QrCodeCore::all();
        $Count = DB::table('qrcode')->count();
        $Sent = DB::table('qrcode')->where("sent", 1)->count();
        $Used = DB::table('qrcode')->where("used", 1)->count();

        $UsersRegistered = DB::table('users')->count();


        $TicketPrice = DB::table('ticketprice')->where('id', 1)->select('price')->value('price');
        $PossibleRevenue = $Count * $TicketPrice;
        $RevenueNow = $Sent * $TicketPrice;

        $Today = DB::table('qrcode')->whereDate('created_at', Carbon::today())->count();
        if ($Today == 0) {
            $Today = 1;
        }
        $Yesterday = DB::table('qrcode')->whereDate('created_at', Carbon::yesterday())->count();
        if ($Yesterday == 0) {
            $Yesterday = 1;
        }
        $PercentValue = (($Today - $Yesterday) / (($Today + $Yesterday) / 2)) * 100;

        $LastUpdate = Carbon::now()->hour;
        $Today = Carbon::now()->toDateString();
        $Users = DB::table('users')->select('id','name','email','email_verified_at','roles')->latest('created_at')->limit(4)->get();

        return view('dashboard.dashboard', compact(
            'QrCodeRequest',
            'Count',
            'Sent',
            'Used',
            'UsersRegistered',
            'RevenueNow',
            'PossibleRevenue',
            'Today',
            'Yesterday',
            'PercentValue',
            'LastUpdate',
            'Today',
            'Users',
        ));
    }

    public function settings(Request $request)
    {
        $request->validate([
            'TicketPrice' => 'required|numeric'
        ]);
        $TicketPrice = $request->get('TicketPrice'); // this is an input with a text
        DB::table('ticketprice')
            ->where('id', 1)
            ->update(['price' => $TicketPrice]);
        return back();
    }

}
