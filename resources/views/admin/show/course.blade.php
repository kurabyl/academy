{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Курсы</h1>
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
            <th>Описание</th>
            <th>Фотография</th>
            <th>Действия</th>

        </tr>
        </thead>
        <tbody>

        @foreach($course as $items)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td><a href="{{url('/admin/course/view/'.$items->id)}}">{{ $items->title }}</a></td>
                <td>{!! $items->description !!}</td>
                <td><img src="{{ asset('image_course/'.$items->image )}}" width="140"></td>
                <td><a href="{{url('/admin/course/edit/'.$items->id)}}"><i class="fas fa-edit"></i></a>
                    <a href="{{url('/admin/course/delete/'.$items->id)}}"><i class="fas fa-trash" style="color:red;"></i></a></td>
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
                    <form action="{{ route('add_course') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Раздел</label>
                            <select name="section" class="form-control" >
                                <option value=""></option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                                @endforeach
                            </select>
                        </div>

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
                            <label for="exampleInputEmail1">Описание</label><br/>
                            <textarea name="description"  cols="50" rows="10" id="exampleInputEmail1" aria-describedby="emailHelp">

                            </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">PRO</label>
                            <input type="checkbox"  name="lock" value="1">
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
