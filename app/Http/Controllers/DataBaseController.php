<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\QrCodeCore;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Illuminate\Filesystem\Filesystem;

class DataBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $QrCodeRequest = QrCodeCore::all();
        $QrCodePagination = DB::table('qrcode')->paginate(20);
        return view('dashboard.database', ['QrCodePagination' => $QrCodePagination], compact('QrCodeRequest'));
    }
    public function view($codes)
    {
        $QrCodeRequest = QrCodeCore::all();
        $QrCodeView = QrCode::format('png')->size(250)->generate($codes);
        $QrCodeView = base64_encode($QrCodeView);
        return
            "<div style='position:absolute;'>
        <p style='display: flex;
        justify-content: center;'>{{$codes}}</p>
        <img src='data:image/png;base64," . $QrCodeView . "'>
        </div>";
    }
    public function download($codes)
    {
        $QrCodeRequest = QrCodeCore::all();
        return response()->download(storage_path('app/QrCodes/' . $codes . '.png'));
    }
    public function delete($id)
    {
        $QrCodeName = DB::table('qrcode')->select('codes')->where('id', $id)->value("codes");
        Storage::delete('QrCodes/' . $QrCodeName .'.png');
        DB::delete('delete from qrcode where id = ?', [$id]);
        return back();
    }
    public function delete_all()
    {
        DB::table('qrcode')->delete();
        $files =   Storage::allFiles('QrCodes');
        Storage::delete($files);
        return back();
    }


    public function update($id)
    {

        if (DB::table('qrcode')->where('id', $id)->value('sent') == false) {
            DB::table('qrcode')->where('id', $id)->update(['sent' => 1, 'sent_at' => now()]);
        }
        else{
            DB::table('qrcode')->where('id', $id)->update(['sent' => 0, 'sent_at' => null]);           
        }
        return back();
    }
}
