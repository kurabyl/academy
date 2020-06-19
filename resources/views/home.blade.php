@extends('layouts.app')

@section('content')
    @if(Session::get('register') == md5('register'))
        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>Сәлем сіздің поштаңызға құпиясөз жіберілді</strong>

        </div>
         <?php
         request()->session()->forget('register');
         ?>
    @endif
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Қош келдіңіз</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body">
                                    <!-- <canvas id="TrafficChart"></canvas>   -->
                                    <iframe width="1000" height="502" src="https://www.youtube.com/embed/NP0ukY6N5cg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
