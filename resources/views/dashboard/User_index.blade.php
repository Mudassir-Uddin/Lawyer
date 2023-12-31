@extends('layout.sidebar')


@section('mydashboard')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h4 class="mb-4">Users Table :</h4>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <a href="{{url('/dashboard/User_index')}}" class="btn btn-primary rounded-pill m-2">All</a>
                            <a href="{{url('/dashboard/User/Sorting')}}/1" class="btn btn-success rounded-pill m-2">User</a>
                            <a href="{{url('/dashboard/User/Sorting')}}/3" class="btn btn-light rounded-pill m-2">Lawyer</a>
                        </div>
                    </div>
                    
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Date Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($service as $ct)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $ct->user_name }}</td>
                                        <td><img src="{{ $ct->img }}" width="80px" height="50px" class="rounded" 
                                            alt=""></td>

                                        <td>{{ $ct->role == 3 ? "Lawyer" : ($ct->role==2 ?  "user": "Admin")  }}</td>
                                        <td>{{ $ct->updated_at = date('Y-m-d') }}</td>

                                        <td>
                                            <a href="{{ url('/dashboard/Users_edit/') }}/{{ $ct->user_id }}"
                                                class="btn btn-warning">Edit</a>
                                            <button onclick="myfun({{ $ct->user_id }})"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <script>
        function myfun(id) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'

                    )
                    window.location.href = "{{ url('/dashboard/U_delete') }}/" + id
                }
            })
            // if (ans) {
            //     var ans = confirm("Do you want to delete ?")

            // }
        }
    </script>
@endsection
