@extends('layouts.admin')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Form Basic</h4>
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
            <div class="col-md-6">
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
                    <form class="form-horizontal" method="post" action="{{ route('savechildcategory') }}">
                        @csrf;
                        <input type="hidden" name="id" id="id" value="" />
                        <div class="card-body">
                            <h4 class="card-title">Sub Category</h4>
                            <div class="form-group row">
                                <label for="category"
                                    class="col-sm-3 text-right control-label col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 text-right control-label col-form-label">Sub
                                    Category</label>
                                <div class="col-sm-9">
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subchildcategory" class="col-sm-3 text-right control-label col-form-label">Sub
                                    Child Category</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subchildcategory" id="subchildcategory"
                                        placeholder="Sub Category">
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Categories</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Sub Child Category</th> <!-- New column -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                @foreach ($category->subcategories as $subcategory)
                                    @foreach ($subcategory->subchildcategories as $subchildcategory)
                                        <!-- New loop -->
                                        <tr>
                                            <th scope="row">{{ $loop->parent->parent->iteration }}</th>
                                            <!-- Update the loop variable -->
                                            <td>{{ $category->category }}</td>
                                            <td>{{ $subcategory->subcategory }}</td>
                                            <td>{{ $subchildcategory->subchildcategory }}</td> <!-- New column data -->
                                            <td>
                                                <a href="javascript:void(0)"
                                                    onclick="editSubChildcategory({{ $subchildcategory->id }},'{{ $subchildcategory->subchildcategory }}','{{ $subchildcategory->category_id }}','{{ $subchildcategory->sub_category_id }}')">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                &nbsp;
                                                <a href="javascript:void(0)"
                                                    onclick="return deleteSubChildcategory({{ $subchildcategory->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/admin/libs/jquery/dist/jquery.min.js') }}"></script>


    <script>
        function deleteSubChildcategory(subchildcategoryid) {
            $.ajax({
                type: "GET",
                url: "{{ route('deletesubchildcategory') }}",
                data: {
                    subchildcategoryid : subchildcategoryid
                },
                success: (response) => {
                    if (response.success) {
                        swal.fire('Good Job', 'Sub Child Category Successfully Deleted!', 'success');
                        location.reload();
                    }
                },
                error: (response, errorThrown) => {
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), "error");
                },
            })
        }
    </script>
    <script>
        function editSubChildcategory(subchildcategoryId, subchildcategoryName, categoryId, subcategoryId) {
            $('#id').val(subchildcategoryId);
            $('#subchildcategory').val(subchildcategoryName);
            $('#category_id').val(categoryId);

            // Trigger the change event to populate the subcategories for the selected category
            $('#category_id').change();

            $('#category_id').change();

            // Check if the subcategoryId exists in the sub_category_id options
            if ($('#sub_category_id option[value="' + subcategoryId + '"]').length > 0) {
                // Set the sub_category_id value and select it
                $('#sub_category_id').val(subcategoryId);
            }
        }
        $(document).ready(function() {
            $('#category_id').change(function() {
                var categoryId = $(this).val(); // Get the selected category ID

                // Make an AJAX request to fetch the subcategories
                $.ajax({
                    url: "{{ route('fetch-subcategories') }}", // Replace with the actual URL to fetch subcategories
                    type: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // Clear the previous options in the sub_category_id select element
                        $('#sub_category_id').empty();
                        $('#sub_category_id').append(
                            '<option value="">Select Subcategory</option>');

                        // Add the new options based on the fetched subcategories
                        $.each(response.subcategories, function(index, subcategory) {
                            $('#sub_category_id').append('<option value="' + subcategory
                                .id + '">' + subcategory.subcategory + '</option>');
                        });
                    },
                    error: function(xhr) {
                        // Handle the error gracefully
                        console.log(xhr.responseText);
                    }
                });
            });

            // Function to pre-fill the fields during editing

        });
    </script>
@endsection
