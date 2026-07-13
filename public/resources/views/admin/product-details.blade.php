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
                            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
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
                            <table class="table table-bordered table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Sub Category
                                        </th>

                                        <th>
                                            Sub Child Category
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <h2 class="text-center">Categories</h2>
                                    <tr>
                                        <td>
                                            {{ $products->category->category }}
                                        </td>
                                        <td>
                                            {{ $products->subCategory->subcategory }}
                                        </td>
                                        <td>
                                            {{ $products->subCategory->subchildcategories[0]->subchildcategory }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-striped">
                                    <tbody>
                                        <h2 class="text-center">Product Details</h2>
                                        <tr>
                                            <th>Product Name</th>
                                            <td>{{ $products->productname }}</td>
                                        </tr>
                                        <tr>
                                            <th>Quantity</th>
                                            <td>{{ $products->MOQ }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>{{ $products->price }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $products->description }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <h2 class="text-center">Attributes</h2>
                                <table
                                    class="table table-bordered table-condensed table-striped w-50 mx-auto bg-primary text-white">
                                    <tbody>
                                        @if ($products->attribute && $products->details)
                                            @foreach (unserialize($products->attribute) as $index => $attribute)
                                                <tr>
                                                    <th>{{ $attribute }}</th>
                                                    <td>{{ $products->details[$index] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                        <h2 class="text-center">Product Images</h2>
                        <div class="row">
                            @foreach ($products->productImages as $image)
                                <div class="col-md-4">
                                    @php
                                        $thumbPath = asset('public/storage/' . $image->images);
                                    @endphp
                                    <img data-imgbigurl="{{ $thumbPath }}" src="{{ $thumbPath }}" alt=""
                                        class="img-fluid p-2">
                                </div>
                            @endforeach
                        </div>
                        @if ($products->user->role !== 'admin')
                            <hr>
                            <h2 class="text-center">Supplier Details</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-striped">
                                    <tr>
                                        <th>Logo</th>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Country</th>
                                        <th>City</th>
                                    </tr>
                                    <tr>
                                        <td align="center" style="vertical-align: middle;">
                                            <img src="{{ asset('public/storage/user-images/' . $products->user->avatar) }}"
                                                class="img-rounded mx-auto" width="100">
                                        </td>
                                        <td style="vertical-align: middle;">{{ $products->user->company_name }}</td>
                                        <td style="vertical-align: middle;">{{ $products->user->firstname }}</td>
                                        <td style="vertical-align: middle;">{{ $products->user->email }}</td>
                                        <td style="vertical-align: middle;">{{ $products->user->contact_number }}</td>
                                        <td style="vertical-align: middle;">{{ $products->user->usercountry->name }}</td>
                                        <td style="vertical-align: middle;">{{ $products->user->city }}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="row">
                                <a href="javascript:void(0)" onclick="return approve({{ $products->id }});"
                                    class="btn btn-success float-left mx-2">Approve</a>
                                <a href="javascript:void(0)" onclick="return reject({{ $products->id }});"
                                    class="btn btn-danger float-left mx-2">Reject</a>
                            </div>
                        @else
                            <h1 class="text-center">
                                This Product Added By Admin
                            </h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="rejectproductmodal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Reason of Rejection</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('rejectproduct') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="productid" id="productid" value="">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ $products->user->email }}" readonly
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="reason">Reason<span class="text-danger">*</span></label>
                                    <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
                                    <!-- Include CKEditor library and initialize -->
                                    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
                                    <script>
                                        // Initialize CKEditor on the 'reason' textarea
                                        CKEDITOR.replace('reason');
                                    </script>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <br>
                                    <input type="submit" name="Save" id="submit"
                                        class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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

        function reject(productid) {
            $('#rejectproductmodal').modal('show');
            $('#productid').val(productid);
        }




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
    </script>
@endsection
