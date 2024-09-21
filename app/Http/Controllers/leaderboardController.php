<?php

namespace App\Http\Controllers;

use App\Models\HasilUjianModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class leaderboardController extends Controller
{
    function getData()
    {
        $leaderboard = User::leftJoin('hasil_ujian', 'users.id', '=', 'hasil_ujian.user_id')
            ->select('users.id as user_id', 'users.name', DB::raw('SUM(COALESCE(hasil_ujian.points, 0)) as points')) // Jumlahkan poin
            ->groupBy('users.id', 'users.name') // Grup berdasarkan user_id dan nama
            ->orderBy('points', 'desc') // Urutkan berdasarkan poin secara menurun
            ->limit(10) // Batasi hasil menjadi 10 entri
            ->get();

        return response()->json([
            'leaderboard' => $leaderboard
        ]);
    }
}
