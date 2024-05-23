<div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Menu</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$item)
                            
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="/ujian/{{ $item->id }}" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Detail">
                                    <i class="now-ui-icons media-1_button-play"></i>
                                </a>

                                <a href="#" onclick="confirmDelete({{ $item->id }})" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Detail">
                                    <i class="now-ui-icons files_box"></i>
                                </a>
                                
                                <script>
                                    function confirmDelete(itemId) {
                                        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                                            Livewire.dispatch('DeleteUjianEmit', {"id": itemId});
                                        }
                                    }
                                </script>
                                
                                
                                  
                            </td>
                            
                        </tr>
                        @endforeach
                     
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

</div>

