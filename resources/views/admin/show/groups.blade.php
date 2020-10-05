{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Группы</h1>
@stop

@section('content')
    @include('messages')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Добавить
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
        Студенты в группу
    </button>
    <p></p>
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>

            <th>Действия</th>

        </tr>
        </thead>
        <tbody>

        @foreach($groups as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->title }}</td>
                <td><a href="{{url('/admin/groups/edit/'.$item->id)}}"><i class="fas fa-edit"></i></a>
                    <a href="{{url('/admin/groups/delete/'.$item->id)}}"><i class="fas fa-trash" style="color:red;"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Группы</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add_groups') }}" method="POST">
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

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Студенты</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add_student_to_group') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Группа</label>
                            <select name="group" id="" class="form-control">
                                @foreach($groups as $item)
                                    <option value="{{ $item->id  }}"> {{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table id="table_id2" class="display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ФИО</th>
                                <th>E-mail</th>

                                <th></th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><input type="checkbox" name="checked[{{ $user->id }}]"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
            $('#table_id2').DataTable();
        } );
    </script>
@stop
