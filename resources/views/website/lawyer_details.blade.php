@extends('layout.index')
@section('mycontent')
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Lawyers Details</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Lawyers Details</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Our Lawyers Areas</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fa fa-landmark"></i>
                            <p>img : {{$users[0]->img}}</p>
                        </div>  
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="service-item">
                        <h3>{{$users[0]->user_name}}</h3>
                        <p>
                            {{$users[0]->address}}
                        </p>
                        <p>
                            {{$users[0]->email}}
                        </p>
                        <a class="btn" href="">Learn More</a>
                    </div>
                </div>  
                {{-- @foreach ($users as $item)
                    
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- Service End -->


@endsection
