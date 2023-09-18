@extends('layout.sidebar')

@section('mydashboard')
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Product insert Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>User</h3>
                            </a>
                            <h3>User Edit</h3>
                        </div>
                        <form action="{{ url('dashboard/User_update') }}/{{ $user->user_id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" value="{{ $user->user_name }}"
                                    name="name" placeholder="jhondoe">
                                <label for="floatingText">Username</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control bg-secondary" id="floatingText"
                                    value="{{ $user->email }}" disabled name="name" placeholder="jhondoe">
                                <label for="floatingText">Username</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="formFileLg" class="form-label">Student Image</label>
                                <input class="form-control  form-control bg-dark" name="img" id="formFileLg"
                                    type="file">
                                @error('img')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <br>
                                @if ($user->img != null)
                                    Old Image : <img src="{{url($user->img)}}" class="img-fluid rounded" width="80px" height="50px" />
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <div class="mb-3">
                                    <label for="formFileLg" class="form-label">Address</label>
                                    <textarea name="address" id="" cols="15" class="form-control" rows="4">{{ $user->address }}</textarea>
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            @if ($lawyer)
                                @if ($user->role == 3)
                                    <h3 class="text-primary mt-5"><i class="fa fa-user-edit me-2"></i>Lawyer</h3>
                                    <div class="mb-3 mt-3">
                                        <label for="formFileLg" class="form-label">Lawyer</label>
                                        <br>
                                        <a href="{{url($lawyer->document)}}" target="blank">View Document</a>
                                    </div>
                                    

                                    <div class="mt-4 mb-3">
                                        <label for="formFileLg" class="form-label">Address</label>
                                        <select name="satisfaction" class="form-select">
                                            <option value="1" {{ $lawyer->satisfaction == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ $lawyer->satisfaction == 0 ? 'selected' : '' }}>
                                                UnActive
                                            </option>
                                            <option value="2" {{ $lawyer->satisfaction == 2 ? 'selected' : '' }}>
                                                Canceled    
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                @endif
                            @endif

                            <button type="submit" class="btn btn-primary     py-3 w-100 mb-4">eidt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product insert End -->
    </div>
@endsection
