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
                <h4 class="page-title">Inquiries</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Inquiries</li>
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    onclick="this.parentElement.style.display='none';">
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
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Vendor</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="customtable">
                                    @foreach ($inquiries as $inquiry)
                                        <tr>
                                            <th>
                                                <label class="customcheckbox">
                                                    <input type="checkbox" class="listCheckbox" />
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <td>{{ $inquiry->products->productname }}</td>
                                            <td>{{ $inquiry->user->firstname }}</td>
                                            <td>{{ $inquiry->subject }}</td>
                                            <td>{{ $inquiry->quantity }}</td>
                                            <td>{{ $inquiry->message }}</td>
                                            @if(Auth::check() && Auth::user()->role == 'admin')
                                            <td>
                                                @php
                                                    $assignedInquiry = $inquiry->assignedInquiry; // Assuming you defined the relationship between Inquiry and AssignInquiry as 'assignedInquiry'
                                                @endphp
                                                @if ($assignedInquiry)
                                                    Assign to Supplier {{ $assignedInquiry->assignedSupplier->firstname }}
                                                @else
                                                    <select class="form-control supplier-select">
                                                        <option>Select Supplier</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->firstname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <input type="hidden" class="inquiry-id" value="{{ $inquiry->id }}">
                                            </td>
                                            @endif
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
        var csrfToken = "{{ csrf_token() }}";
        // When the user selects a supplier, handle the event
        $('#suppliers').on('change', function() {
            // Get the selected supplier ID
            var supplierId = $(this).val();

            // Get the corresponding inquiry ID from the hidden input in the same row
            var inquiryId = $(this).closest('tr').find('.inquiry-id').val();

            // AJAX request to store the data in the table
            $.ajax({
                url: '{{ route('assign-inquiry') }}', // Replace this with the endpoint to handle the AJAX request on the server-side
                method: 'POST', // Use the appropriate HTTP method (POST, GET, etc.)
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request header
                },
                data: {
                    supplier_id: supplierId,
                    inquiry_id: inquiryId,
                    // You can add any additional data you want to send to the server
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Assigned',
                        text: 'Inquiry Successfully Assigned'
                    }).then(function() {
                        // Handle the Sweet Alert "Okay" button click
                        // For this example, we reload the page after the "Okay" button is clicked
                        location.reload();
                    });
                },
                error: function(error) {
                    // Handle the error if something goes wrong with the AJAX request
                    console.error(error);
                    swal("Error!", "An error occurred while assigning the inquiry.", "error");
                }
            });
        });
    </script>
@endsection
