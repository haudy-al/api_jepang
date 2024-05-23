<div>
    <div class="content">
        <div class="card">

            <div class="card-header">
                @if ($tambahSoalBtn == true)
                    <button wire:click='clickCloseTambahSoalBtn' type="button" class="btn btn-sm btn-secondary">
                        Batal
                    </button>
                @else
                    <button wire:click='clickTambahSoalBtn' type="button" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                @endif
            </div>
            <div class="card-body">


                @if ($tambahSoalBtn == true)
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">

                        @if ($image)
                            <div class="mb-3">

                                <img src="{{ $image->temporaryUrl() }}" width="300px" alt="">
                                <button type="button" class="btn btn-sm" wire:click="removeImage()"><i
                                        class="fa-solid fa-x"></i></button>
                            </div>
                        @endif

                        @if ($audio)
                            <div class="mb-3">

                                <audio controls>
                                    <source src="{{ $audio->temporaryUrl() }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                <button type="button" class="btn btn-sm" wire:click="removeAudio()"><i
                                        class="fa-solid fa-x"></i></button>
                            </div>
                        @endif

                        <input type="file" id="inputImage" wire:model='image' class="d-none">
                        <input type="file" id="inputAudio" wire:model.live='audio' class="d-none">
                        <div class="input-group mb-3">
                            <textarea class="form-control" wire:model='question' placeholder="Soal.."></textarea>
                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @foreach ($inputs as $index => $input)
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model.live="inputs.{{ $index }}"
                                    placeholder="pilihan...">
                                <button type="button" class="btn btn-sm"
                                    wire:click="removeInput({{ $index }})"><i class="fa-solid fa-x"></i></button>
                            </div>
                            @error('inputs.' . $index)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach
                        <div class="input-group mb-3 mt-3">
                            <span class="input-group-text" id="basic-addon1">Jawaban</span>
                            <select class="form-control" wire:model.live='correct_answer' id="">
                                @foreach ($inputs as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('correct_answer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <button type="button" class="btn badge btn-info" wire:click="addInput">Tambah Pilihan</button>
                        <label for="inputImage" class="btn badge btn-secondary text-light"><i
                                class="fa-solid fa-image"></i> Gambar</label>
                        <label for="inputAudio" class="btn badge btn-secondary text-light"><i
                                class="fa-solid fa-file-audio"></i> Audio</label>
                        <button type="submit" class="btn badge btn-success"><i class="fa-solid fa-floppy-disk"></i>
                            Simpan</button>
                    </form>
                @else
                    <div class="row">

                        @foreach ($dataSoal as $item)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        @if ($item->image_url)
                                            <img src="{{ asset('storage/'.$item->image_url) }}" alt="">
                                            <br><br>
                                        @endif
                                        @if ($item->audio_url)
                                        <audio controls>
                                            <source src="{{ asset('storage/'.$item->audio_url) }}" type="audio/mpeg" />
                                            Your browser does not support the audio element.
                                        </audio>
                                            <br><br>
                                        @endif
                                        <p>{{ $item->question }}</p>
                                    </div>
                                    <ul class=" mt-3">
                                        @foreach ($item->choices as $row)
                                            <li class="list-group-item-custom border-0 text-small">{{ $row }}
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="card-body">
                                        <p>Jawaban : {{ $item->correct_answer }}</p>

                                    </div>

                                    <div class="card-footer">
                                        <div class="">
                                            <a href="/ujian/{{ $idUjian }}/soal/edit/{{ $item->id }}"><i
                                                    class="fa-solid fa-pen-to-square text-warning"></i></a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    @if (count($dataSoal) < 1)
                        <div class="alert alert-warning">
                            <i class="fa-solid fa-triangle-exclamation"></i> Data Kosong
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>

   
    

    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <script>
                showCustomAlertWithLoader("{{ $err }}", 'danger');
            </script>
        @endforeach
    @endif

</div>
