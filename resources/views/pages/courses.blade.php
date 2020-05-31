@extends('layouts.app')
@section('roadmap')
    <!-- Content -->
    @include('messages')

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
                            <ol class="breadcrumb text-right">
                                <li><a href="/">Басты бет</a></li>
                                <li>{{$listCourse->title}}</li>

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
                @foreach($listCourse->courses as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('image_course/'.$item->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-3">{{ $item->title }}</h4>
                                <p class="card-text"> {{ $item->description }} </p>
                                <a href="{{url('student/course/list/'.$item->id.'/?section='.$listCourse->title.'&sec_id='.$listCourse->id)}}" class="btn btn-primary">Толығырақ</a>

                                <a href="#" class="btn btn-info"><i class="fa fa-pencil"></i> Сатып аламын</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- .row -->
        </div>
    </div>
@endsection
