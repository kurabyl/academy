{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактировать курсы</h1>
@stop

@section('content')
    @include('messages')

    <form action="{{ route('edit_course') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Раздел</label>
            <select name="section" class="form-control" >
                <option value=""></option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}"  @if($course->section_id == $section->id) selected @endif>{{ $section->title }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{ request()->id }}">
        <input type="hidden" name="old_image" value="{{ $course->image }}">
        <div class="form-group">

            <label for="exampleInputEmail1">Название</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ $course->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('title')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Описание</label><br/>
            <textarea name="description"  cols="50" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp">
                                {{ $course->description }}
                            </textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            @if($course->image)
                <img src="{{ asset('image_course/'.$course->image) }}" alt="" width="140">
            @endif
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="hidden" class="hidden-input" name="type">
                <input type="file" name="image" class="custom-file-input" id="input-cover">
                <label class="custom-file-label" for="input-cover">Выбрать файл</label>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">PRO</label>
            <input type="checkbox"  name="lock" value="{{ $course->lock == 1 ? 1 : 2 }}" @if($course->lock == 1) checked @endif>
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
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@stop
