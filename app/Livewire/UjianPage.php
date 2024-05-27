<?php

namespace App\Livewire;

use App\Models\SoalUjianModel;
use App\Models\UjianModel;
use Livewire\Component;

class UjianPage extends Component
{

    public $btnTambahSoal = false;

    public $title;
    public $description;  
    public $start_time;
    public $end_time;
    public $work_time = 60;

    protected $listeners = ['DeleteUjianEmit' => 'DeleteUjian'];

    public function render()
    {

        if ($this->work_time < 0) {
            $this->work_time = 0;
            ltrim($this->work_time, '0');

        }
        
        $dataUjian = UjianModel::orderBy('created_at', 'DESC')->get();

        return view('livewire.ujian-page', ['data' => $dataUjian]);
    }

    function clickTambahUjianBtn() {
        $this->btnTambahSoal = true;
    }

    function clickCloseTambahUjianBtn() {
        $this->btnTambahSoal = false;
    }

    function submit() {
        $this->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'work_time' => 'required',
           
        ]);
    }

    function DeleteUjian($id)
    {
        $dataUjian = UjianModel::where('id', $id)->get()->first();

        try {
            $dataSoal = SoalUjianModel::where('ujian_id', $id)->get();
        
            if ($dataSoal->isNotEmpty()) {
                $count = count($dataSoal);
                for ($i = 0; $i < $count; $i++) {
                    $row = $dataSoal[$i];
                    if ($row->image_url == null) {
                        $row->image_url = 'kosong';
                    }
        
                    $image = storage_path('app/public/' . $row->image_url);
                    

                    if (file_exists($image)) {
                        unlink($image);
                    }


                    if ($row->audio_url == null) {
                        $row->audio_url = 'kosong';
                    }
        
                    $audio = storage_path('app/public/' . $row->audio_url);
                    

                    if (file_exists($audio)) {
                        unlink($audio);
                    }
                }
            } 
        
        } catch (\Throwable $th) {
            $this->dispatch('danger', ['message' => 'Terjadi Kesalahan: ' . $th->getMessage()]);
        }
        



        $dataUjian->delete();
        $this->dispatch('danger', ['message' => 'Data Berhasil Dihapus']);
    }
}
