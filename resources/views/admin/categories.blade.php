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
                    <form class="form-horizontal" method="post" action="{{ route('savecategory') }}">
                        @csrf;
                        <input type="hidden" name="id" id="id" value=""/>
                        <div class="card-body">
                            <h4 class="card-title">Personal Info</h4>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3 text-right control-label col-form-label">First
                                    Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="category" id="category"
                                        placeholder="Category">
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->category }}</td>
                                    <td><a href="javascript:void(0)" onclick="editcategory({{ $category->id }})"><i
                                        class="fas fa-edit"></i></a> &nbsp; <a href="javascript:void(0)"
                                    onclick="return deletecategory({{ $category->id }})"><i
                                        class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script>
        function editcategory(categoryid) {
            $.ajax({
                type: "GET",
                url: "{{ route('editcategory') }}",
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
    </script>
    <script>
        function deletecategory(categoryid) {
            $.ajax({
                type: "GET",
                url: "{{ route('deletecategory') }}",
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
