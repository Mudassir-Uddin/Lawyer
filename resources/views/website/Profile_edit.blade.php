@extends('layout.index')
@section('mycontent')
    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="section-header">
                <h2>{{ $role == 3 ? 'Lawyer' : 'User' }} Profile</h2>
            </div>
            <form method="POST" action="{{route('userProfilePost',[$id])}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info">
                            <div class="contact-item" style="align-items: center">
                                <img src="{{ $user->img }}" style="width: 100%; height:400px"/>
                            </div>
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" value="{{ $user->user_name }}"
                                    placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Email" value="{{ $user->email }}"
                                    placeholder="Your Email" disabled />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message" name="address" required="required">
                                    {{ $user->address }}
                                </textarea>
                            </div>
                            <div>
                                <button class="btn" type="submit">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact End -->
@endsection
