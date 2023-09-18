@extends('layout.index')
@section('mycontent')
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Lawyers</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Case Studies</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Portfolio Start -->
    <div class="portfolio">
        <div class="container">
            <div class="section-header">
                <h2>Our Lawyers Studies</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".first">Civil</li>
                        <li data-filter=".second">Criminal</li>
                        <li data-filter=".third">Business</li>
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container">
                @foreach ($users as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first">
                        <div class="portfolio-wrap">
                            {{-- <img src=" {{ $item->img }}" alt="Portfolio Image"> --}}
                            <img src="{{ url('/website/img/portfolio-1.jpg') }}" alt="Portfolio Image">

                            <figure>
                                <a class="btn" href="{{ url('/lawyer_details') }}/{{ $item->user_id }}">
                                    <p> {{ $item->user_name }}</p>
                                    <a href="#"> {{ $item->email }}</a>
                                    <span> {{ $item->address }}</span>
                                </a>
                            </figure>
                        </div>
                    </div>
                @endforeach

            </div>
           
        </div>
    </div>
    <!-- Portfolio Start -->
@endsection
