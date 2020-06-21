{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Панель управления</h1>
@stop

@section('content')
    <style>
        .box-me
        {
            float:left;
            width: 250px;
            height:100px;
            text-align: center;
            margin: 10px;
            background: #ffffff;
            font-size: 20px;
            border: 1px solid #eeeeee;
        }
    </style>
    <div style="margin: 29px;">
        <div class="box-me">
            <p style="margin-top:20px;">
            Пользователь<br>
                {{ $users->count() }}
            </p>
        </div>

        <div class="box-me">
            <p style="margin-top:20px;">
                Разделы<br>
                {{ $section->count() }}
            </p>
        </div>

        <div class="box-me">
            <p style="margin-top:20px;">
                Курсы<br>
                {{ $course->count() }}
            </p>
        </div>

        <div class="box-me">
            <p style="margin-top:20px;">
                Видео<br>
                {{ $video->count() }}
            </p>
        </div>

    </div>

    <canvas id="myChart" width="400" height="400"></canvas>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">


@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


@stop
