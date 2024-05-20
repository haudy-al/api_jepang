<?php

namespace App\Http\Controllers;

use App\Models\UjianModel;
use App\Models\UjianTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ujianController extends Controller
{
    function index()
    {
        $data = UjianModel::all();

        return response()->json($data);
    }

    function getUjianToken($ujian_id, $user_id)
    {
        // Cek apakah token sudah ada
        $data = UjianTokenModel::where('ujian_id', $ujian_id)->where('user_id', $user_id)->first();
        if (!$data) {
            // Jika tidak ada, buat token baru
            $now = Carbon::now();
            $tenMinutesLater = $now->addMinutes(10);
            $formattedDateTime = $tenMinutesLater->toDateTimeString();

            $token = sha1($now . 'ujian'); // Buat token dengan waktu sekarang
            $data = UjianTokenModel::create([
                'token' => $token,
                'ujian_id' => $ujian_id,
                'user_id' => $user_id,
                'expired' => $formattedDateTime
            ]);
        }

        // Berikan token dalam respons JSON
        return response()->json($data);
    }
}
