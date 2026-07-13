<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center ">
                            <h4 class="card-title">Categories</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add_category">Add
                                Category</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">No of Sub Categories</th>
                                        <th class="w-1">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->blogsubcategory->count() }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-sm btn-primary mx-1"
                                                        wire:click.prevent='editcategory({{ $category->id }})'>Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No Category found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center ">
                            <h4 class="card-title">Sub Categories</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add_subcategory">Add Sub
                                Category</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SubCategory</th>
                                        <th scope="col">Parent Category</th>
                                        <th class="w-1">No of Post</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->blogparentcategory->category_name }}</td>
                                        <td>{{$subcategory->posts->count()}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-primary mx-1" wire:click.prevent='editsubcategory({{ $subcategory->id }})'>Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div wire:ignore.self class="modal" id="add_category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $updateCategoryMode ? 'Update Category' : 'Add Category' }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" class="form-horizontal"
                            @if ($updateCategoryMode) wire:submit.prevent='updateCategory()' @else wire:submit.prevent='saveCategory()' @endif>
                            @if ($updateCategoryMode)
                                <input type="hidden" wire:model='selected_category_id'>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="category_name"
                                            class="text-right control-label col-form-label">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" placeholder="Name"
                                            wire:model='category_name'>
                                        <span class="text-danger">
                                            @error('category_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="border-top card-body d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger mr-2"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-primary">{{ $updateCategoryMode ? 'Update' : 'Save' }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div wire:ignore.self class="modal" id="add_subcategory">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $updatesubCategoryMode ? 'Update Subcategory' : 'Add Subcategory' }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" class="form-horizontal"
                            @if ($updatesubCategoryMode) wire:submit.prevent='updateSubCategory()' @else wire:submit.prevent='saveSubCategory()' @endif>
                            @if ($updatesubCategoryMode)
                                <input type="hidden" wire:model='selected_subcategory_id'>
                            @endif
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="parent_category"
                                            class="text-right control-label col-form-label">Parent Category Type</label>
                                        <select class="form-control" name="parent_category" id="parent_category"
                                            wire:model='parent_category'>
                                            @if (!$updatesubCategoryMode)
                                                <option value="">No Selected</option>
                                            @endif
                                            @foreach (\App\Models\BlogCategory::all() as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('parent_category')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subcategory_name"
                                            class="text-right control-label col-form-label">Subcategory Name</label>
                                        <input type="text" class="form-control" id="subcategory_name"
                                            placeholder="Name" wire:model='subcategory_name'>
                                        <span class="text-danger">
                                            @error('subcategory_name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top row">
                                <div class="card-body d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger mr-2"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary">{{ $updatesubCategoryMode ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
