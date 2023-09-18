@extends('layout.form')
@section('myform')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <div class="container-fluid position-relative d-flex p-0">

        <!-- User insert Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-around mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>lawyers_website</h3>
                            </a>
                            <h3>Profile Edit</h3>
                        </div>
                        <form action="{{ url('/registerstore') }}" method="POST" enctype="multipart/form-data" id="loginForm">

                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" name="name"
                                    value="{{ old('name') }}" placeholder="Name">
                                <label for="floatingText">Name</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    id="floatingText" placeholder="Email">
                                <label for="floatingText">Email</label>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="pass" id="floatingText" class="form-control"
                                    value="{{ old('pass') }}" placeholder="Password">
                                <label for="floatingText">Password</label>
                                @error('pass')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <textarea name="address" rows="5" class="form-control" value="{{ old('address') }}" id="floatingText"
                                    placeholder="Address"></textarea>
                                <label for="floatingText">Address</label>

                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="chkLayer">
                                <input type="hidden" name="checks" value="0" />
                                <input type="checkbox" id="chkLayer" name="checks" value="1" />
                                Is Lawyer !
                            </label>
                            <hr />
                            <div id="div" style="display:none;">
                                <div class="form-floating mb-3">
                                    <input type="file" name="document" class="form-control">
                                    @error('document')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea name="QUALIFICATION" rows="5" class="form-control" rows="3" id="floatingText" value="{{ old('QUALIFICATION') }}" placeholder="QUALIFICATION"></textarea>
                                    <label for="floatingText">QUALIFICATION</label>
                                    @error('QUALIFICATION')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <script type="text/javascript">
                                $(function() {
                                    $("#chkLayer").click(function() {
                                        if ($(this).is(":checked")) {
                                            $("#div").show();
                                        } else {
                                            $("#div").hide();
                                        }
                                    });
                                });
                            </script>

                            {{-- <div class="mb-3">
                                <label for="formFileLg" class="form-label">Category Image</label>
                                <input class="form-control form-control-lg bg-dark" name="img" id="formFileLg"
                                    type="file">

                                @error('img')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- User insert End -->
    </div>

@endsection

