@extends('layouts.admin')
@section('content')
<style>
    .switch input {
        display: none;
    }

    .switch {
        display: inline-block;
        width: 30px;
        height: 15px;
        margin: 0px;
        /* transform: translateY(50%); */
        position: relative;
    }

    /* Style Wired */
    .slider {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 30px;
        box-shadow: 0 0 0 2px #777, 0 0 4px #777;
        cursor: pointer;
        border: 4px solid transparent;
        overflow: hidden;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        width: 100%;
        height: 100%;
        background: #777;
        border-radius: 30px;
        transform: translateX(-15px);
        transition: .4s;
    }

    input:checked+.slider:before {
        transform: translateX(10px);
        background: limeGreen;
    }

    input:checked+.slider {
        box-shadow: 0 0 0 2px limeGreen, 0 0 2px limeGreen;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (session('success'))
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Plan</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="customtable">
                                @foreach ($memberships as $membership)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{ $membership->user->firstname }} {{ $membership->user->lastname }}</td>
                                    <td>{{ $membership->user->email }}</td>
                                    <td>{{ $membership->user->contact_numer }}</td>
                                    <td>
                                        {{ $membership->plan_type == 0 ? 'Basic Listing' : ($membership->plan_type == 1 ? 'Enhanced Visibility' : 'Premium Showcase') }}
                                    </td>

                                    <td>${{ $membership->price }}</td>
                                    <td style="color: {{ $membership->status == 0 ? 'red' : ($membership->status == 1 ? 'green' : 'black') }}">
                                        {{ $membership->status == 0 ? 'Pending' : ($membership->status == 1 ? 'Paid' : 'Unknown') }}
                                    </td>
                                    <td>
                                        <div>
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                            <label class="switch">
                                                <input type="checkbox" data-membership-id="{{ $membership->id }}" @if ($membership->status == 1) checked @endif>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.switch input[type="checkbox"]').on('change', function() {
            var membershipId = $(this).data('membership-id');
            var status = this.checked ? 1 : 0;
            var csrfToken = $('#csrf-token').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                url: '{{ route('status-member-ship') }}',
                type: 'POST',
                data: {
                    membershipId: membershipId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'The status has been successfully updated.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error updating status');
                }
            });
        });
    });
</script>
@endsection