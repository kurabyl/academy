{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Добавить видео курсы</h1>
@stop

@section('content')
    @include('messages')
    @if(!request()->dopvideo)
    <form action="{{ route('add_videocourse') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Раздел</label>
            <select  class="form-control" onchange="location = this.value;">
                <option value=""></option>
                @foreach($sections as $section)
                    <option value="{{ url('admin/videocourse/add?section='.$section->id) }}" @if(request()->section == $section->id) selected @endif">{{ $section->title }}</option>
                @endforeach
            </select>
            <input type="hidden" name="section" value="{{ request()->section }}">
        </div>
        @if(request()->section)
            <div class="form-group">
                <label for="exampleInputEmail1">Курсы</label>
                <select name="course" class="form-control">


                        @foreach(\App\UseCases\Section\SectionListService::listCourse(request()->section) as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach

                </select>
            </div>
        @endif

        <div class="form-group">

            <label for="exampleInputEmail1">Название</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('title')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="exampleInputEmail1">Видео</label>
            <input type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ old('video') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('video')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Описание</label><br/>
            <textarea name="description"  cols="50" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp">

                            </textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
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

            <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
    @else
        <form action="{{ route('add_dopvideo') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Видео</label>
                <select name="video_id"  class="form-control" >
                    <option value=""></option>
                    @foreach($video as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">

                <label for="exampleInputEmail1">Название</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('title')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="form-group">

                <label for="exampleInputEmail1">Видео</label>
                <input type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ old('video') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('video')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Никому не видно</label>
                <input type="checkbox"  name="lock" value="1">
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
    @endif
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
