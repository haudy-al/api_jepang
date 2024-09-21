<?php

namespace App\Http\Controllers;

use App\Models\HasilUjianModel;
use App\Models\SoalUjianModel;
use App\Models\UjianModel;
use App\Models\UjianTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ujianController extends Controller
{
    function ujianPage()
    {
        return view('ujian');
    }

    function DetailUjianPage($id)
    {
        return view('ujian.detailUjian', ["id" => $id]);
    }

    function getUjianData()
    {
        $data = UjianModel::all();

        return response()->json($data);
    }

    function getUjianSoalData($ujian_id)
    {
        $data = SoalUjianModel::where('ujian_id', $ujian_id)->get();

        return response()->json($data);
    }

    function getUjianToken($ujian_id, $user_id)
    {
        $dataUjian = UjianModel::where('id', $ujian_id)->get()->first();
        $data = UjianTokenModel::where('ujian_id', $ujian_id)->where('user_id', $user_id)->first();
        if (!$data) {


            $now = Carbon::now();
            $MinutesLater = $now->addMinutes($dataUjian->work_time);
            $formattedDateTime = $MinutesLater->toDateTimeString();

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

    function checkUjianToken($token)
    {
        $data = UjianTokenModel::where('token', $token)->get()->first();
        return response()->json($data);
    }

    function submitUjian(Request $req)
    {
        $data = $req->all();  // Ini akan mengambil semua data yang dikirim dalam request

        // Lakukan validasi jika diperlukan
        if (!isset($data['user_id']) || !isset($data['ujian_id']) || !isset($data['hasil_ujian'])) {
            return response()->json([
                'message' => 'Data tidak valid.',
                'error' => 'Invalid request data.'
            ], 400);
        }

        // Proses jawaban...
        $userId = $data['user_id'];
        $ujianId = $data['ujian_id'];
        $hasilUjian = $data['hasil_ujian'];

        $totalPoints = 0;

        foreach ($hasilUjian as $jawabanUser) {
            $soalId = $jawabanUser['soalId'];
            $jawaban = $jawabanUser['jawaban'];

            // Dapatkan soal dari database
            $soal = DB::table('soal_ujian')->where('id', $soalId)->where('ujian_id', $ujianId)->first();

            if ($soal && $jawaban === $soal->correct_answer) {
                $totalPoints += $soal->points;
            }
        }

        // Cek apakah sudah ada data hasil ujian untuk user ini
        $existingRecord = HasilUjianModel::where('user_id', $userId)
            ->where('ujian_id', $ujianId)
            ->first();

        if ($existingRecord) {
            return response()->json([
                'message' => 'Hasil ujian sudah ada untuk user ini.',
                'error' => 'Duplicate entry.'
            ]);
        }

        $hasilUjianModel = new HasilUjianModel();
        $hasilUjianModel->ujian_id = $ujianId;
        $hasilUjianModel->user_id = $userId;
        $hasilUjianModel->jawaban = json_encode($hasilUjian); 
        $hasilUjianModel->points = $totalPoints;
        $hasilUjianModel->save();


        return response()->json([
            'user_id' => $userId,
            'ujian_id' => $ujianId,
            'total_points' => $totalPoints,
            'message' => 'Pengecekan selesai.'
        ]);
    }
}
