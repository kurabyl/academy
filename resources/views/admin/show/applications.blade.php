{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Заявки</h1>
@stop

@section('content')
    @include('messages')
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>E-mail</th>
            <th>Телефон</th>
            <th>КУРС</th>
            <th>Статус</th>
            <th>Дата заявки</th>

            <th>Опции</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            @foreach($user->application as $application)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->details['phone'] }}</td>
                    <td> {{ $application->course['title'] }}</td>
                    <td> @if($application->status == 0)
                            <strong class="btn btn-info">Ожидает</strong>
                        @else
                            <strong class="btn btn-success">Активировано</strong>
                        @endif
                    </td>
                    <td>{{ $application->created_at }}</td>
                    <td>
                        @if($application->status == 0)
                            <a href="{{url('/admin/applications/active/'.$application->id)}}"><i class="fas fa-edit"></i>Активировать</a>
                        @else
                            <a href="{{url('/admin/applications/deactive/'.$application->user_id.'/course/'.$application->course_id.'?app='.$application->id)}}"><i class="fas fa-edit"></i>Деактировать</a>
                        @endif
                    </td>
            </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
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
