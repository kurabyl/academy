{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактировать раздел</h1>
@stop

@section('content')
@include('messages')

    <form action="{{ route('edit_section') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Название</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ $section->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('title')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            <input type="hidden" name="id" value="{{ request()->id }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Иконка</label>
            <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ $section->icon }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('icon')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>

</div>
<div class="modal-footer">

    <button type="submit" class="btn btn-primary">Редактировать</button>
</div>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@stop
