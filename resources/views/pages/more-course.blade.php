@extends('layouts.app')
@section('roadmap')
    <!-- Content -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-8">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1> {{ $more->title }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <style>
        ::-webkit-scrollbar {
            height: 1px;              /* height of horizontal scrollbar ← You're missing this */
            width: 1px;               /* width of vertical scrollbar */

        }
        .number {
            display: inline-block;
            text-align: center;
            width: 1.5rem;
            line-height: 1.5rem;
            font-size: .8rem;
            background: #ddd;
            color: #333;
            border-radius: 100px;
        }
    </style>
    <div class="content">
        <!--  Traffic  -->
        <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <!-- <canvas id="TrafficChart"></canvas>   -->
                                <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $more->video }}"></div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    {{ htmlspecialchars_decode($more->description) }}
                                </div>
                                <div class="mb-3"></div>

                                </div>
                            </div>
                        </div>

                        </div>
                    </div> <!-- /.row -->
                    <div class="card-body"></div>
                </div>
            </div><!-- /# column -->
        </div>
        <!--  /Traffic -->
    </div>
@endsection
