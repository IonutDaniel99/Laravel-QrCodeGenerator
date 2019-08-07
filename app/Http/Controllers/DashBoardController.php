<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QrCodeCore;
use DB;

class DashBoardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $TicketPrice = 37.3;

        $QrCodeRequest = QrCodeCore::all();
        $Count = DB::table('qrcode')->count();
        $Sent = DB::table('qrcode')->where("sent",1)->count();
        $Used = DB::table('qrcode')->where("used",1)->count();

        $PossibleRevenue = $Count * $TicketPrice;
        $RevenueNow = $Sent * $TicketPrice;
        return view('dashboard.dashboard', compact('QrCodeRequest','Count','Sent','Used','RevenueNow','PossibleRevenue'));
    }
}
