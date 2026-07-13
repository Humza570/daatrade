<div>
    <section>
        <div class="container">
            <div class="row mt-2">
                <div class="col-12 col-md-6">
                    <!-- Left side with "Authors" (full width on mobile, half width on medium and larger screens) -->
                    <h2>Authors</h2>
                </div>
                <div class="col-12 col-md-6">
                    <!-- Right side with Search and "Add an Author" button (full width on mobile, half width on medium and larger screens) -->
                    <div class="d-flex justify-content-end">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#add_author">Add an
                            Author</button>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($authors as $author)
                <div class="col-md-4">
                    <div class="box1 box">
                        <div class="content">
                            <div class="image">
                                <img src="https://i.postimg.cc/bryMmCQB/profile-image.jpg" alt="Profile Image">
                            </div>
                            <div class="level">
                                <p class="mb-0">{{ $author->role }}</p>
                            </div>
                            <div class="text">
                                <p class="name">{{ $author->firstname }}</p>
                                <p class="job_title">{{ $author->email }}</p>
                                <p class="job_discription">{{ $author->biography }}</p>
                            </div>
                            <div class="button">
                                <div>
                                    <button class="message" type="button"
                                        wire:click.prevent='editAuthor({{ $author }})'>Edit</button>
                                </div>
                                <div>
                                    <button class="connect" type="button"
                                        wire:click.prevent='deleteAuthor({{ $author }})'>Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <span class="text-danger">No Author Found</span>
                @endforelse

            </div>
        </div>
    </section>
    <!-- The Modal -->
    <div wire:ignore.self class="modal" id="add_author">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Author</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form wire:submit.prevent='addAuthor()' method="POST" class="form-horizontal">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Name"
                                    wire:model='firstname'>
                                <span class="text-danger">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="abc@xyz.com"
                                    wire:model='email'>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username"
                                class="col-sm-3 text-right control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                    wire:model='username'>
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="authortype" class="col-sm-3 text-right control-label col-form-label">Author
                                Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="authortype" id="authortype" wire:model='authortype'>
                                    <option value="">Select Author</option>
                                    <option value="author">Author</option>
                                </select>
                                <span class="text-danger">
                                    @error('authortype')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Is direct Publisher?</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation1"
                                        name="radio-stacked" name="direct_publisher" wire:model='direct_publisher'
                                        value="0">
                                    <label class="custom-control-label" for="customControlValidation1">No</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation2"
                                        name="radio-stacked" name="direct_publisher" wire:model='direct_publisher'
                                        value="1">
                                    <label class="custom-control-label" for="customControlValidation2">Yes</label>
                                </div>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="border-top row">
                            <div class="card-body d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mr-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div wire:ignore.self class="modal" id="edit_author">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Author</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form wire:submit.prevent='updateAuthor()' method="POST" class="form-horizontal">
                        <input type="hidden" wire:model.prevent='selected_author_id'>
                        <div class="form-group row">
                            <label for="name"
                                class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Name"
                                    wire:model='firstname'>
                                <span class="text-danger">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" placeholder="abc@xyz.com"
                                    wire:model='email'>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username"
                                class="col-sm-3 text-right control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                    wire:model='username'>
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="authortype" class="col-sm-3 text-right control-label col-form-label">Author
                                Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="authortype" id="authortype"
                                    wire:model='authortype'>

                                    <option value="author">Author</option>
                                </select>
                                <span class="text-danger">
                                    @error('authortype')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Is direct Publisher?</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation1"
                                        name="radio-stacked" name="direct_publisher" wire:model='direct_publisher'
                                        value="0">
                                    <label class="custom-control-label" for="customControlValidation1">No</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="customControlValidation2"
                                        name="radio-stacked" name="direct_publisher" wire:model='direct_publisher'
                                        value="1">
                                    <label class="custom-control-label" for="customControlValidation2">Yes</label>
                                </div>
                            </div>
                            <span class="text-danger">
                                @error('direct_publisher')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group row">
                            <div class="switch">
                                <input class="switch" id="switch" name="switch" type="checkbox"
                                    wire:model='blocked' /><label data-off="OFF" data-on="ON"
                                    for="switch"></label>
                            </div>
                        </div>
                        <div class="border-top row">
                            <div class="card-body d-flex justify-content-end">
                                <button type="button" class="btn btn-danger mr-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


</div>
