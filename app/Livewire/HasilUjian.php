<?php

namespace App\Livewire;

use App\Models\HasilUjianModel;
use Livewire\Component;

class HasilUjian extends Component
{
    public function render()
    {

        $data = HasilUjianModel::orderBy('created_at','DESC')->get();

        return view('livewire.hasil-ujian',[
            'data'=>$data
        ]);
    }
}
