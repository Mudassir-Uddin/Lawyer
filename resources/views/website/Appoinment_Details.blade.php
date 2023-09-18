@extends('layout.index')
@section('mycontent')
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Appoinment Details</h2>
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
                <h2>Our Appoinment Areas</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Place Of Mee</th>
                                <th scope="col">Date of Meeting</th>
                                <th scope="col">Apointment Status</th>
                                @if ($role == 3)
                                    <th scope="col">Confirmation</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($appoin as $item)
                                @php
                                    $count++;
                                @endphp
                                <tr>

                                    <th scope="row">{{ $count }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->place }}</td>
                                    <td>{{ $item->meeting_date }}</td>
                                    @php
                                        $statusMsg = 'pending';
                                        if ($item->booking_status == 1) {
                                            $statusMsg = 'Pending';
                                        } elseif ($item->booking_status == 2) {
                                            $statusMsg = 'Done';
                                        } elseif ($item->booking_status == 3) {
                                            $statusMsg = 'canceled';
                                        } else {
                                            $statusMsg = '-----';
                                        }
                                    @endphp
                                    <td>{{ $statusMsg }}</td>
                                    @if ($role == 3)
                                        <td>
                                            <form method="POST"
                                                action="{{ url('/AppointmentConfirm') }}/{{ $item->id }}"
                                                class="myForm">
                                                @csrf
                                                <select name="confirmValue" class="form-control myDropdown">
                                                    <option value="1"
                                                        {{ $item->booking_status == 1 ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="2"
                                                        {{ $item->booking_status == 2 ? 'selected' : '' }}>
                                                        Done</option>
                                                    <option value="3"
                                                        {{ $item->booking_status == 3 ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                </select>
                                            </form>

                                        </td>
                                    @endif

                                </tr>
                            @endforeach



                            <script>
                                const dropdowns = document.querySelectorAll(".myDropdown");

                                dropdowns.forEach(dropdown => {
                                    dropdown.addEventListener("change", function() {
                                        this.closest(".myForm").submit();
                                    });
                                });
                            </script>



                        </tbody>
                    </table>
                </div>
                {{-- @foreach ($users as $item)
                    
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
