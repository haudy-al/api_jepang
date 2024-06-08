<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JishoController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
        $response = Http::get("https://jisho.org/api/v1/search/words?keyword=" . urlencode($keyword));
        return $response->json();
    }
}
