<?php

namespace App\Livewire;

use App\Models\SoalUjianModel;
use App\Models\UjianModel;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailUjian extends Component
{

    use WithFileUploads;

    // komponen
    public $tambahSoalBtn = false;
    // end komponen

    public $idUjian;

    public $question;
    public $image;
    public $audio;
    public $inputs = [''];
    public $correct_answer;
    
    public function mount($id)
    {
        $this->idUjian = $id;
    }

    function clickTambahSoalBtn() {
        $this->tambahSoalBtn = true;
    }

    function clickCloseTambahSoalBtn() {
        $this->tambahSoalBtn = false;
    }

    public function addInput()
    {
        $this->inputs[] = '';
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs); // reindex array
    }

    function removeAudio() {
        $this->audio = null;
    }

    function removeImage() {
        $this->image = null;
    }

    function clearInputAll() {
        $this->removeAudio();
        $this->removeImage();
        $this->inputs = [''];
        $this->question = null;
    }

    public function submit()
    {
        
        $this->validate([
            'inputs.*' => 'required|string',
            'question' => 'required|string',
            'audio' => 'nullable|file|mimes:mpga,mp3,wav|max:3240', 
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:3240',
        ]);

        $inputsValues = array_values($this->inputs);

        $type = 'text';

        if ($this->audio) {
            $type = 'audio';
            $audioPath = $this->audio->store('audios', 'public');
        }

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        SoalUjianModel::create([
            'ujian_id'=>$this->idUjian,
            'type'=>$type,
            'question'=>$this->question,
            'choices'=>$inputsValues,
            'correct_answer'=>$this->correct_answer,
            'audio_url'=>$audioPath ?? null,
            'image_url'=>$imagePath ?? null
        ]);


        // Reset input setelah submit
        $this->clearInputAll();
        $this->clickCloseTambahSoalBtn();
        $this->dispatch('success',['message'=>'Data Berhasil Ditambahkan']);

    }
    
    public function render()
    {
        $dataUjian = UjianModel::where('id',$this->idUjian)->get()->first();
        $dataSoal = SoalUjianModel::where('ujian_id',$this->idUjian)->get();

        if (count($this->inputs) == 1) {
            $this->correct_answer = $this->inputs[0] ;
        }elseif (count($this->inputs) < 1) {
            $this->correct_answer = null;
        }

        return view('livewire.detail-ujian',['dataUjian'=>$dataUjian,'dataSoal'=>$dataSoal]);
    }
}
