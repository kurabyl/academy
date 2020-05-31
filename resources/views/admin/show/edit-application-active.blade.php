{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Активировать</h1>
@stop

@section('content')
    @include('messages')
    <div class="col-7">
    <form action="{{ route('active_application') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="exampleInputEmail1">Варианты</label>
            <select name="variants" class="form-control" >
                <option value="20"> 20 мин </option>
                <option value="30"> 30 дней </option>
                <option value="60"> 60 дней </option>
                <option value="90"> 90 дней </option>
            </select>
        </div>
        <input type="hidden" name="id" value="{{ request()->id }}">

        <div class="modal-footer">

            <button type="submit" class="btn btn-primary">Активировать</button>
        </div>
    </form>
    </div>

@stop


