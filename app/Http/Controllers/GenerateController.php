<?php

namespace App\Http\Controllers;

use App\QrCodeCore;
use DB;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;


class GenerateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $QrCodeApp = QrCodeCore::all();
        $CheckRecords = DB::table('qrcode')->select('codes')->count();
        if ($CheckRecords > 0) {
            $CodesRequest = DB::table('qrcode')->select('codes')->orderBy('id', 'desc')->first()->codes;
            return view('dashboard.generate', compact('CodesRequest', 'CheckRecords'));
        } else {
            return view('dashboard.generate', compact('CheckRecords'));
        }
        return view('dashboard.generate');
    }
    public function create(Request $request)
    {
        $QrCodeApp = QrCodeCore::all();
        return view('dashboard.generate', compact('QrCodeApp'));
    }

    public function StoreFirst(Request $request)
    {
        $request->validate([
            'Pre-Text1' => 'required',
            'SingleNumberGenerator' => 'required|numeric',
        ]);
        $QrCodeRequest = QrCodeCore::all();
        $qrcode = new QrCodeCore();
        $pre_text = $request->get('Pre-Text1'); // this is an input with a text
        $number = $request->get('SingleNumberGenerator'); // input but with numbers
        $checkboxvalue = $request->get("CheckBoxValue");
        if($checkboxvalue == "on"){
            $qrcodetext =  $pre_text . $number++; // "A non-numeric value encountered"
            DB::table('qrcode')->insert(['codes'=>$qrcodetext,'sent' => 1, 'sent_at' => now()]);
            $QrCodeView = QrCode::format('png')->size(250)->generate($qrcodetext);
            $QrCodeView = base64_encode($QrCodeView);
            $image = $QrCodeView;
            $image = str_replace('data:image/png;base64,', '', $image);
            $imageName = $qrcodetext . '.' . 'png';
            Storage::put('QrCodes/' . $imageName, base64_decode($image));
        }else{
            $qrcodetext =  $pre_text . $number++; // "A non-numeric value encountered"
            DB::insert('insert into qrcode (codes) values (?)', [$qrcodetext]);
            $QrCodeView = QrCode::format('png')->size(250)->generate($qrcodetext);
            $QrCodeView = base64_encode($QrCodeView);
            $image = $QrCodeView;
            $image = str_replace('data:image/png;base64,', '', $image);
            $imageName = $qrcodetext . '.' . 'png';
            Storage::put('QrCodes/' . $imageName, base64_decode($image));
        }


        //return view('dashboard.generate');
        return back();
    }

    public function StoreSecond(Request $request)
    {
        $request->validate([
            'Pre-Text2' => 'required',
            'MultipleNumberGenerator' => 'required|numeric',
            'How_Many' => 'numeric|min:2|max:500'
        ]);
        $QrCodeRequest = QrCodeCore::all();
        $qrcode = new QrCodeCore();
        $pre_text = $request->get('Pre-Text2'); // this is an input with a text
        $number = $request->get('MultipleNumberGenerator'); // input but with numbers
        $how_many = $request->get('How_Many'); //
        for ($i = 1; $i <= $how_many; $i++) {
            $qrcodetext =  $pre_text . $number++; // "A non-numeric value encountered"
            DB::insert('insert into qrcode (codes) values (?)', [$qrcodetext]);
            $QrCodeView = QrCode::format('png')->size(250)->generate($qrcodetext);
            $QrCodeView = base64_encode($QrCodeView);
            $image = $QrCodeView;
            $image = str_replace('data:image/png;base64,', '', $image);
            $imageName = $qrcodetext . '.' . 'png';
            Storage::put('QrCodes/' . $imageName, base64_decode($image));
        };
        return back();
    }


}
