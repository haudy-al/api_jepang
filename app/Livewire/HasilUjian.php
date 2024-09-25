<?php

namespace App\Livewire;

use App\Mail\SendCertificate;
use App\Models\HasilUjianModel;
use App\Models\SoalUjianModel;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class HasilUjian extends Component
{
    public function render()
    {

        $data = HasilUjianModel::orderBy('created_at', 'DESC')->get();

        return view('livewire.hasil-ujian', [
            'data' => $data
        ]);
    }


    function BTNSendCertificate($id)
    {

        $dataHasil = HasilUjianModel::where('id', $id)->get()->first();


        $dataMail = [
            'name' => $dataHasil->user->name,
            'score' => $dataHasil->points,
            'total_score' =>  SoalUjianModel::where('ujian_id', $dataHasil->ujian_id)->sum('points'),

            'nama_ujian' => $dataHasil->ujian->title,
        ];

        Mail::to($dataHasil->user->email)->send(new SendCertificate($dataMail));

        $this->dispatch('success', ['message' => 'Data Berhasil Dikirim']);
    }
}
