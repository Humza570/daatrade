<div>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" class="form-control" placeholder="Search" wire:model='search'>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" wire:model='category'>
                        <option value="">Select Category</option>
                        @foreach (\App\Models\BlogSubCategory::whereHas('posts')->get() as $category)
                            <option value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <select class="form-control" id="author" wire:model='author'>
                            <option value="">Select Author</option>
                            @foreach (\App\Models\User::whereHas('posts')->get() as $author)
                                <option value="{{ $author->id }}">{{ $author->firstname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-md-2">
                <div class="form-group">
                    <label for="orderBy">orderBy</label>
                    <select class="form-control" id="orderBy" wire:model='orderBy'>
                        <option value="asc">ASC</option>
                        <option value="desc">DESC</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse($allposts as $post)
                <div class="col-md-4">
                    <div class="box1 box">
                        <div class="content">
                            <div class="image">
                                <img src="{{ asset('images/post_images/thumbnails/thumbnail_200x200_' . $post->featured_image) }}"
                                    alt="Profile Image">
                            </div>
                            <div class="level">
                                <p class="mb-0">{{ $post->post_title }}</p>
                            </div>

                            <div class="postbutton">
                                <div>
                                <button class="message" onclick="window.location.href='{{ route('edit-post', $post->id) }}'" target="_blank">Edit</button>
                                </div>
                                <div>
                                    <button class="connect"onclick="window.location.href='{{ route('delete-post', $post->id) }}'" target="_blank" type="button">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-danger">No Post Found</span>
            @endforelse
        </div>
        <div class="d-block mt-2">
            {{ $allposts->links('livewire::simple-bootstrap') }}
        </div>
    </div>

</div>
