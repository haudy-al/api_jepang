@extends('layouts.app')
@section('custom-cdn')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

@endsection
@section('content')
    @livewire('ujian-page')

    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
