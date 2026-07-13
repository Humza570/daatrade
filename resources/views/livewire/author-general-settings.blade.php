<div>
    <form class="form-horizontal" method="post" wire:submit.prevent='updateGeneralSettings()'>
        <div class="card">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="text-right control-label col-form-label">Blog
                            Name</label>
                        <input type="text" class="form-control" id=""
                            wire:model='blog_name'>
                        <span class="text-danger">
                            @error('blog_name')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="" class="text-right control-label col-form-label">Blog
                            Email</label>
                        <input type="text" class="form-control" id="" wire:model='blog_email'>
                        <span class="text-danger">
                            @error('blog_email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="" class="text-right control-label col-form-label">Blog
                            Description</label>
                        <textarea id="" col="3" rows="3" class="form-control" wire:model='blog_description'></textarea>
                        <span class="text-danger">
                            @error('blog_description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
