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
                    <form class="form-horizontal" method="post" action="{{ route('savesubcategory') }}">
                        @csrf;
                        <input type="hidden" name="id" id="id" value="" />
                        <div class="card-body">
                            <h4 class="card-title">Sub Category</h4>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 text-right control-label col-form-label">Category</label>
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
                                <label for="subcategory" class="col-sm-3 text-right control-label col-form-label">Sub
                                    Category</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subcategory" id="subcategory"
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            @foreach ($category->subcategories as $subcategory)
                            <tr>
                                <th scope="row">{{ $loop->parent->iteration }}</th>
                                <td>{{ $category->category }}</td>
                                <td>{{ $subcategory->subcategory }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="editSubcategory({{ $subcategory->id }},'{{ $subcategory->subcategory }}','{{ $subcategory->category_id }}')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="javascript:void(0)" onclick="return deleteSubcategory({{ $subcategory->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- <script>
        function editsubcategory(categoryid) {
            $.ajax({
                type: "GET",
                url: "{{ route('editsubcategory') }}",
                data: {
                    categoryid: categoryid
                },
                success: (response) => {
                    $('#id').val();
                    $('#category').val();
                    if (response.status) {
                        $('#id').val(response.data.id);
                        $('#category').val(response.data.category);
                    }
                },
                error: (response, status, errorThrown) => {
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), "error");
                },
            })
        }
    </script> --}}

    <script>
        function editSubcategory(subcategoryId, subcategoryName, categoryId) {
            document.getElementById('id').value = subcategoryId;
            document.getElementById('subcategory').value = subcategoryName;
            document.getElementById('category_id').value = categoryId;
        }
    </script>
    <script>
        function deleteSubcategory(categoryid) {
            $.ajax({
                type: "GET",
                url: "{{ route('deletesubcategory') }}",
                data: {
                    categoryid: categoryid
                },
                success: (response) => {
                    if (response.success) {
                        swal.fire('Good Job', 'Category Successfully Deleted!', 'success');
                        location.reload();
                    }
                },
                error: (response, errorThrown) => {
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), "error");
                },
            })
        }
    </script>
@endsection
