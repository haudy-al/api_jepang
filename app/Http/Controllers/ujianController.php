<?php

namespace App\Http\Controllers;

use App\Models\SoalUjianModel;
use App\Models\UjianModel;
use App\Models\UjianTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ujianController extends Controller
{
    function ujianPage() {
        return view('ujian');
    }

    function DetailUjianPage($id) {
        return view('ujian.detailUjian',["id"=>$id]);
    }

    function getUjianData()
    {
        $data = UjianModel::all();

        return response()->json($data);
    }

    function getUjianSoalData($ujian_id) {
        $data = SoalUjianModel::where('ujian_id',$ujian_id)->get();

        return response()->json($data);
    }

    function getUjianToken($ujian_id, $user_id)
    {
        $dataUjian = UjianModel::where('id',$user_id)->get()->first();
        $data = UjianTokenModel::where('ujian_id', $ujian_id)->where('user_id', $user_id)->first();
        if (!$data) {
            $now = Carbon::now();
            $tenMinutesLater = $now->addMinutes($dataUjian->work_time);
            $formattedDateTime = $tenMinutesLater->toDateTimeString();

            $token = sha1($now . 'ujian'); 
            $data = UjianTokenModel::create([
                'token' => $token,
                'ujian_id' => $ujian_id,
                'user_id' => $user_id,
                'expired' => $formattedDateTime
            ]);
        }

        return response()->json($data);
    }

    function checkUjianToken($token) {
        $data = UjianTokenModel::where('token',$token)->get()->first();
        return response()->json($data);
    }
}
