@extends('layouts.app')
@section('roadmap')
    <!-- Content -->
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{$listCourse->title}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right" style="text-transform:none">
                                <li><a href="{{ url('/') }}">Басты бет</a></li>
                                <li><a href="{{ url('student/section/'.request()->sec_id) }}">{{ request()->section }}</a></li>
                                <li class="active">{{$listCourse->title}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                @foreach($listCourse->videos as $item)
                    @if($item->status == 0)
                       @if($item->groups($item->id))
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('image_course/'.$item->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">{{ $item->title }}</h4>
                                    <p></p>
                                    <a href="{{url('student/course/more/'.$item->id.'/?section='.request()->section.'&sec_id='.request()->sec_id.'&c='.$item->title.'&c_id='.$item->id)}}" class="btn btn-success">Сабақ оку</a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('image_course/'.$item->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">{{ $item->title }}</h4>
                                    <p></p>
                                    <a href="{{url('student/course/more/'.$item->id.'/?section='.request()->section.'&sec_id='.request()->sec_id.'&c='.$item->title.'&c_id='.$item->id)}}" class="btn btn-success">Сабақ оку</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                @endforeach
            </div><!-- .row -->
        </div>
    </div>
@endsection
