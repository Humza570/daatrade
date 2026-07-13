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
                <h4 class="page-title">Products</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
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
                        @if (Auth::check() && (Auth::user()->role = 'admin' || (Auth::user()->role = 'supplier')))
                            <a href="{{ route('addproducts') }}" class="btn btn-success mb-2">Add Products</a>
                        @endif
                        <div class="table-responsive">
                            <form action="{{ route('delete-products') }}" method="POST">
                                @csrf
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>

                                            </th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Added By</th>
                                            <th scope="col">Top Export</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="customtable">
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="p-0 text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup"
                                                            class="custom-control-input checkbox-item" name="productid[]"
                                                            id="checkbox-{{ $product->id }}" value="{{ $product->id }}">
                                                        <label for="checkbox-{{ $product->id }}"
                                                            class="custom-control-label">&nbsp;</label>
                                                    </div>

                                                </td>
                                                <td>{{ $product->productname }}</td>
                                                <td>{{ $product->MOQ }}</td>
                                                <td>{{ $product->user->usercountry->name }}</td>
                                                <td>{{ $product->user->city }}</td>
                                                <td>{{ $product->user->role }}</td>
                                                <td>
                                                    @if ($product->status === 2)
                                                        Rejected
                                                    @else
                                                        <div>
                                                            <input type="hidden" name="_token" id="csrf-token"
                                                                value="{{ csrf_token() }}">
                                                            <label class="switch">
                                                                <input type="checkbox"
                                                                    data-product-id="{{ $product->id }}"
                                                                    @if ($product->featured == 1) checked @endif>
                                                                <span class="slider"></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->status === 2)
                                                        Product is Rejected
                                                        <a href="javascript:void(0)" onclick="return approve({{ $product->id }});"
                                                            > <br>Click Here</a> to Approve
                                                    @else
                                                        <a href="{{ route('product-details', $product->id) }}"
                                                            target="_blank" class="btn float-left mx-1 px-1"><i
                                                                class="fas fa-eye"></i></a>
                                                        <a href="{{route('EditProduct',$product->id)}}" target="_blank"
                                                            class="btn float-left mx-1 px-1"><i class="fas fa-edit"></i></a>
                                                            @if ((Auth::user()->role == 'admin'))
                                                            <a href="{{route('DeleteProduct',$product->id)}}"
                                                            class="btn float-left mx-1 px-1"><i class="fas fa-trash"></i></a>
                                                            @endif   
                                                    @endif

                                                    {{-- <div class="float:left mt-1">
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                                                <label class="switch">
                                                    <input type="checkbox" data-product-id="{{ $product->id }}" @if ($product->status == 1) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                            </div> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <button type="submit" id="deleteButton" class="btn btn-danger"
                                    style="display: none;">Delete</button>



                            </form>
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
                var productId = $(this).data('product-id');
                var featured = this.checked ? 1 : 0;
                var csrfToken = $('#csrf-token').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    url: '{{ route('make-top-export') }}',
                    type: 'POST',
                    data: {
                        productId: productId,
                        featured: featured
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

    <script>
        // Event listener for the "check all" checkbox
        $("#checkbox-all").change(function() {
            $(".checkbox-item").prop("checked", $(this).prop("checked"));
            toggleDeleteButton();
        });

        // Event listener for individual checkboxes
        $(".checkbox-item").change(function() {
            toggleDeleteButton();
        });
        // Function to toggle the visibility of the delete button
        function toggleDeleteButton() {
            var anyChecked = $(".checkbox-item:checked").length > 0;
            if (anyChecked) {
                $("#deleteButton").show();
            } else {
                $("#deleteButton").hide();
            }
        }
        function approve(product_id) {
            $.ajax({
                url: "{{ route('approveproduct') }}",
                method: 'POST', // Change to POST method for updating data
                data: {
                    _token: '{{ csrf_token() }}', // Add CSRF token for security
                    product_id: product_id
                },
                success: function(response) {
                    alert('Product approved');
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.status === 401) {
                        alert('Unauthorized');
                    } else if (xhr.status === 404) {
                        alert('Product not found');
                    } else {
                        alert('An error occurred');
                    }
                }
            });
        }
    </script>
@endsection
