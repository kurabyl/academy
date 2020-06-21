{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактировать видео курсы</h1>
@stop

@section('content')
    @include('messages')

    <form action="{{ route('edit_videocourse') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Раздел</label>
            <select  class="form-control" onchange="location = this.value;">
                <option value=""></option>
                @foreach($sections as $section)
                    <option value="{{ url('admin/videocourse/edit/'.request()->id.'/?section='.$section->id) }}" @if($video->section_id == $section->id) selected @endif>{{ $section->title }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="section" value="{{ request()->section ?? $video->section_id }}" >

        @if(request()->section ?? $video->section_id)
            <div class="form-group">
                <label for="exampleInputEmail1">Курсы</label>
                <select name="course" class="form-control">


                        @foreach(\App\UseCases\Section\SectionListService::listCourse(request()->section ?? $video->section_id) as $item)
                        <option value="{{ $item->id }}" @if($video->course_id == $item->id) selected @endif>{{ $item->title }}</option>
                        @endforeach

                </select>
            </div>
        @endif

        <div class="form-group">

            <label for="exampleInputEmail1">Название</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $video->title }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('title')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="exampleInputEmail1">Видео</label>
            <input type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ $video->video }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('video')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

        </div>
        <input type="hidden" name="id" value="{{ request()->id }}">
        <input type="hidden" name="old_image" value="{{ $video->image }}">

        <div class="form-group">
            <label for="exampleInputEmail1">Описание</label><br/>
            <textarea name="description"  cols="50" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp">
                    {{ $video->description }}
                            </textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            @if($video->image)
                <img src="{{ asset('image_course/'.$video->image) }}" alt="" width="140">
            @endif
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="hidden" class="hidden-input" name="type">
                <input type="file" name="image" class="custom-file-input" id="input-cover">
                <label class="custom-file-label" for="input-cover">Выбрать файл</label>
            </div>
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
