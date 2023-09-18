@extends('layout.index')
@section('mycontent')


<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Services</h2>
            </div>
            <div class="col-12">
                <a href="">Home</a>
                <a href="">Case Studies</a>
            </div>
        </div>
    </div>
</div>
         <!-- Service Start -->
         <div class="service">
            <div class="container">
                <div class="section-header">
                    <h2>Our Services Areas</h2>
                </div>
                <div class="row">
                    @foreach ($service as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                {{-- <i class="fa fa-landmark"></i> --}}
                                <img src=" {{ $item->img }}" width="340px" height="190px">
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non
                            </p>
                            <a class="btn" href="">Learn More</a>
                        </div>
                    </div>
               
                @endforeach
            </div>
            </div>
         </div>
         
        </div>
    </div>
    <!-- Portfolio Start -->
@endsection
