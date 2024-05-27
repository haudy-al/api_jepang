<div>
    <div class="content">
        <div class="card">
            <div class="card-header">

                @if ($btnTambahSoal == true)
                    <button wire:click='clickCloseTambahUjianBtn' type="button" class="btn btn-sm btn-secondary">
                        Batal
                    </button>
                @else
                    <button wire:click='clickTambahUjianBtn' type="button" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                @endif
            </div>
            <div class="card-body">
                @if ($btnTambahSoal == true)
                    <div class="row">
                        <div class="col-md-6">
                            <form wire:submit.prevent="submit" enctype="multipart/form-data">

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Judul</span>
                                    <input wire:model='title' type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Judul Ujian..."
                                        aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group mb-3">
                                    <lable>Deskripsi : @error('description') <span class="text-danger">{{ $message }}</span> @enderror</span>
                                        <textarea wire:model='description' class="form-control " style="min-width: 100%" placeholder="Text..."></textarea>
                                        <br>
                                        
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Waktu Mulai Ujian</span>
                                    <input wire:model='start_time' type="datetime-local" class="form-control @error('title') is-invalid @enderror">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Waktu Selesai Ujian</span>
                                    <input wire:model='end_time' type="datetime-local" class="form-control @error('title') is-invalid @enderror">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Waktu Pengerjaan</span>
                                    <input type="number" wire:model.live='work_time' class="form-control @error('title') is-invalid @enderror" style="border-radius: 0">
                                    <span class="input-group-text" id="basic-addon1">Menit</span>

                                </div>

                                <br>

                                <button type="submit" class="btn badge btn-success"><i
                                        class="fa-solid fa-floppy-disk"></i>
                                    Simpan</button>
                            </form>
                        </div>
                        
                    </div>
                @else
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Menu</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <a href="/ujian/{{ $item->id }}" rel="tooltip" title=""
                                            class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Detail">
                                            <i class="now-ui-icons media-1_button-play"></i>
                                        </a>

                                        <a href="#" onclick="confirmDelete({{ $item->id }})" rel="tooltip"
                                            title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Detail">
                                            <i class="now-ui-icons files_box"></i>
                                        </a>

                                        <script>
                                            function confirmDelete(itemId) {
                                                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                                                    Livewire.dispatch('DeleteUjianEmit', {
                                                        "id": itemId
                                                    });
                                                }
                                            }
                                        </script>



                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>

</div>
