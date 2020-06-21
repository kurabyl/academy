{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Студенты</h1>
@stop

@section('content')
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>E-mail</th>
            <th>Пол</th>
            <th>Телефон</th>
            <th>Инстаграм</th>
            <th>Телеграм</th>
            <th>Дата регистрация</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->details['gender'] }}</td>
                <td>{{ $user->details['phone'] }}</td>
                <td>{{ $user->details['instagram'] }}</td>
                <td>{{ $user->details['telegram'] }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{url('/admin/user/delete/'.$user->id)}}"><i class="fas fa-trash" style="color:red;"></i></a>
                </td>
            </tr>
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
