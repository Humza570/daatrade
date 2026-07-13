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
            <a href="{{ route('DownloadExcel', $type) }}" class="btn btn-success btn-lg">Export</a>
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
                                    <th>
                                        <label class="customcheckbox m-b-20">
                                            <input type="checkbox" id="mainCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Registration #</th>
                                    @if(Route::currentRouteName() == 'vendormanagement')
                                    <th scope="col">Membership</th>
                                    @endif
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="customtable">
                                @foreach ($users as $user)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact_numer }}</td>
                                    <td>{{ $user->company_name }}</td>
                                    <td>{{ $user->company_registration_number }}</td>
                                    @if(Route::currentRouteName() == 'vendormanagement')
                                    <td>@if(isset($user->membership->plan_type))
                                        @if ($user->membership->plan_type == '0') <div class="dropdown">
                                        <img src="{{ asset('assets/img/Badge-01.png') }}"  class="circle-image" alt="Badge"> 
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userTypeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Basic Listing
        </button>
        <div class="dropdown-menu" aria-labelledby="userTypeDropdown">
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '1']) }}">Enhanced Visibility</a>
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '2']) }}" >Premium Showcase</a>
        </div>@endif
                                        @if ($user->membership->plan_type == '1') <div class="dropdown">
                                        <img src="{{ asset('assets/img/Badge-02.png') }}"  class="circle-image" alt="Badge">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userTypeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Enhanced Visibility
        </button>
        <div class="dropdown-menu" aria-labelledby="userTypeDropdown">
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '0']) }}" >Basic Listing</a>
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '2']) }}">Premium Showcase</a>
        </div> @endif
                                        @if ($user->membership->plan_type == '2')  <div class="dropdown">
                                        <img src="{{ asset('assets/img/Badge-03.png') }}"  class="circle-image" alt="Badge">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userTypeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Premium Showcase
        </button>
        <div class="dropdown-menu" aria-labelledby="userTypeDropdown">
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '0']) }}" >Basic Listing</a>
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '1']) }}">Enhanced Visibility</a>
        </div> @endif
                                        @if ($user->membership->plan_type == 'free') <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userTypeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Free
        </button>
        <div class="dropdown-menu" aria-labelledby="userTypeDropdown">
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '0']) }}">Basic Listing</a>
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '1']) }}" >Enhanced Visibility</a>
            <a class="dropdown-item" href="{{ route('changemembershipplan', ['user' => $user->id, 'type' => '2']) }}" >Premium Showcase</a>
        </div>
    </div> @endif
                                        @else
                                        Give Free?
                                        <label class="switch">
                                            <input type="checkbox" name="freemembership" value="free" data-user-id="{{ $user->id }}">
                                            <span class="slider"></span>
                                        </label>
                                        @endif
                                    </td>
                                    @endif
                                    <td>
                                        <div>
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                            <label class="switch">
                                                <input type="checkbox" name="user-status" data-user-id="{{ $user->id }}" @if ($user->status == 1) checked @endif>
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
        $('input[name="freemembership"]').change(function() {
        if(this.checked) {
            var userId = $(this).data('user-id');
            var value = $(this).val();
            var csrfToken = $('#csrf-token').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                url: '{{ route('free-membership-status') }}',
                type: 'POST',
                data: {
                    userId: userId,
                    value: value
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Free Membership',
                        text: 'Free Membership give Successfully.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error');
                }
            });
        } else {
            console.log("Checkbox is unchecked");
        }
    });


        $('.switch input[name="user-status"]').on('change', function() {
            var userId = $(this).data('user-id');
            var status = this.checked ? 1 : 0;
            var csrfToken = $('#csrf-token').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                url: '{{ route('update-user-status') }}',
                type: 'POST',
                data: {
                    userId: userId,
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