{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Разделы</h1>
@stop

@section('content')
    @include('messages')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Добавить
    </button>
    <p></p>
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Иконка</th>
            <th>Действия</th>

        </tr>
        </thead>
        <tbody>

        @foreach($sections as $section)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $section->title }}</td>
                <td><i class="fa {{ $section->icon }}" style="font-size: 35px"></i></td>
                <td><a href="{{url('/admin/section/edit/'.$section->id)}}"><i class="fas fa-edit"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Разделы</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add_section') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('title') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Иконка</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('icon')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
