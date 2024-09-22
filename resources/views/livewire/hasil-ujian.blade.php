<div>
    <div class="content">
        <div class="card">
            <div class="card-header">

               
            </div>
            <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Ujian</th>
                            <th scope="col">Poin</th>
                            <th scope="col">*</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->ujian->title }}</td>
                                <td>{{ $item->points }}</td>
                                <td>
                                    
                                  <button>Cetak</button>

                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
