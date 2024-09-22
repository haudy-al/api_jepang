<?php

namespace App\Livewire;

use App\Models\SoalUjianModel;
use App\Models\UjianModel;
use Livewire\Component;
use Livewire\WithFileUploads;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;

class DetailUjian extends Component
{

    use WithFileUploads;
   

    public $idUjian;


    protected $drive;
    protected $client;

    // komponen
    public $tambahSoalBtn = false;
    // end komponen


    public $question;
    public $points;
    public $image;
    public $audio;
    public $inputs = [''];
    public $correct_answer;
    
    

    public function mount($id)
    {

        // dd(session()->get('google_drive_token'));


        $this->idUjian = $id;

        // $this->client = new GoogleClient();
        // $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        // $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        // $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
    
        // if (session()->has('google_drive_token')) {
        //     $this->client->setAccessToken(session()->get('google_drive_token'));
        //     $this->drive = new GoogleDrive($this->client);

        //     // dd($this->drive->files);
        

        // } else {
        //     // Handle situasi ketika token tidak tersedia
        // }
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
            'audio' => 'nullable|file|mimes:mpga,mp3,wav,m4a,audio/mp4,audio/x-m4a|max:3240',
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

        // if ($this->image) {
        //     $file = $this->image->getRealPath();
        //     $fileMetadata = new DriveFile([
        //         'name' => $this->image->getClientOriginalName(),
        //     ]);
        //     $content = file_get_contents($file);
        //     $uploadedFile = $this->drive->files->create($fileMetadata, [
        //         'data' => $content,
        //         'mimeType' => $this->image->getMimeType(),
        //         'uploadType' => 'multipart',
        //     ]);
        //     $imagePath = $uploadedFile->getWebContentLink();
        // }

        SoalUjianModel::create([
            'ujian_id'=>$this->idUjian,
            'type'=>$type,
            'question'=>$this->question,
            'choices'=>$inputsValues,
            'correct_answer'=>$this->correct_answer,
            'audio_url'=>$audioPath ?? null,
            'image_url'=>$imagePath ?? null,
            'points'=>$this->points

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
