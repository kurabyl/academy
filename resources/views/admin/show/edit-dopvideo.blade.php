{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Добавить видео </h1>
@stop

@section('content')
    @include('messages')

        <form action="{{ route('edit_dopvideo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Видео</label>
                <select name="video_id"  class="form-control" >
                    <option value=""></option>
                    @foreach($video as $item)
                        <option value="{{ $item->id }}" @if($videos->video_id == $item->id) selected @endif>{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" value="{{ $videos->id }}" name="id">

            <div class="form-group">

                <label for="exampleInputEmail1">Название</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $videos->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('title')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="form-group">

                <label for="exampleInputEmail1">Видео</label>
                <input type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ $videos->video }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('video')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
@stop

@section('css')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@stop
