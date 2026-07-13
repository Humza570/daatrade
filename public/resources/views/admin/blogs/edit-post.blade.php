@extends('layouts.admin')

<style>
    .panel {
        margin: 0px auto;
        max-width: 250px;
        text-align: center;
    }

    .button_outer {
        background: #83ccd3;
        border-radius: 30px;
        text-align: center;
        height: 50px;
        width: 200px;
        display: inline-block;
        transition: 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn_upload {
        padding: 15px 30px;
        color: #fff;
        text-align: center;
        position: relative;
        display: inline-block;
        overflow: hidden;
        z-index: 3;
        white-space: nowrap;
    }

    .btn_upload input {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
        width: 100%;
        height: 105%;
        cursor: pointer;
        opacity: 0;
    }

    .file_uploading {
        width: 100%;
        height: 10px;
        margin-top: 20px;
        background: #ccc;
    }

    .file_uploading .btn_upload {
        display: none;
    }

    .processing_bar {
        position: absolute;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        border-radius: 30px;
        background: #83ccd3;
        transition: 3s;
    }

    .file_uploading .processing_bar {
        width: 100%;
    }

    .success_box {
        display: none;
        width: 50px;
        height: 50px;
        position: relative;
    }

    .success_box:before {
        content: "";
        display: block;
        width: 9px;
        height: 18px;
        border-bottom: 6px solid #fff;
        border-right: 6px solid #fff;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        position: absolute;
        left: 17px;
        top: 10px;
    }

    .file_uploaded .success_box {
        display: inline-block;
    }

    .file_uploaded {
        margin-top: 0;
        width: 50px;
        background: #83ccd3;
        height: 50px;
    }

    .uploaded_file_view {
        max-width: 300px;
        margin: 40px auto;
        text-align: center;
        position: relative;
        transition: 0.2s;
        opacity: 0;
        border: 2px solid #ddd;
        padding: 15px;
    }

    .file_remove {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: block;
        position: absolute;
        background: #aaa;
        line-height: 30px;
        color: #fff;
        font-size: 12px;
        cursor: pointer;
        right: -15px;
        top: -15px;
    }

    .file_remove:hover {
        background: #222;
        transition: 0.2s;
    }

    .uploaded_file_view img {
        max-width: 100%;
    }

    .uploaded_file_view.show {
        opacity: 1;
    }

    .error_msg {
        text-align: center;
        color: #f00;
    }
</style>
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Edit Post</h4>
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
<div class="container">
    <form method="post" action="{{ route('posts-create') }}" enctype="multipart/form-data" id="addPostForm">
        @csrf
        <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="post_title">Post Title</label>
                            <input type="text" name="post_title" placeholder="Enter Post Title" value="{{$post->post_title}}" class="form-control">
                            <span class="text-danger error-text post_title_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="post_content">Post Content</label>
                            <textarea class="form-control" id="post_content" name="post_content" placeholder="Content..." rows="6">{{$post->post_content}}</textarea>

                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                                <label for="tags-input" >Keywords</label>
                                @php
                                $tagsArray = unserialize($post->keywords);
                                @endphp

                                <input type="text" class="form-control" id="tags-input" value="{{ implode(',', $tagsArray) }}" placeholder="Enter Keywords for SEO" name="tags[]">
                                <div class="error text-danger" id="tags-input-error"></div>
                        </div>
                        <div class="form-group mb-3">
                                <label for="tags-input" >Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Enter Description for SEO " name="description" value="{{$post->description}}" required>
                                <div class="error text-danger" id="tags-input-error"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="post_category">Post Category</label>
                            <select class="form-control" id="post_category" name="post_category">
                                <option value="">No Category Selected</option>
                                @foreach (\App\Models\BlogSubCategory::all() as $category)
                                <option value="{{ $category->id }}"  @if($post->category_id == $category->id ) selected @endif>{{ $category->subcategory_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text post_category_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            {{-- <input type="file" name="featured_image" id="featured_image" class="form-control p-0"> --}}
                            <main class="main_full">
                                <div class="container">
                                    <div class="panel">
                                        <div class="button_outer">
                                            <div class="btn_upload">
                                                <input type="file" id="featured_image" name="featured_image">
                                                Feature Image
                                            </div>
                                            <div class="processing_bar"></div>
                                            <div class="success_box"></div>
                                        </div>
                                    </div>
                                    <div class="error_msg"></div>
                                    <img src="{{ asset('images/post_images/thumbnails/thumbnail_200x200_' . $post->featured_image) }}"
                                    alt="Profile Image" id="feature">
                                    <div class="uploaded_file_view" id="uploaded_view">
                                        <span class="file_remove">X</span>
                                    </div>
                                </div>
                            </main>
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        CKEDITOR.replace('post_content');
    });
</script>
<script>
    var btnUpload = $("#featured_image"),
        btnOuter = $(".button_outer");
    btnUpload.on("change", function(e) {
        var ext = btnUpload.val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $(".error_msg").text("Not an Image...");
        } else {
            $(".error_msg").text("");
            btnOuter.addClass("file_uploading");
            setTimeout(function() {
                btnOuter.addClass("file_uploaded");
            }, 3000);
            var uploadedFile = URL.createObjectURL(e.target.files[0]);
            setTimeout(function() {
                $("#uploaded_view").append('<img src="' + uploadedFile + '" />').addClass("show");
                $("#feature").hide();
            }, 3500);
        }
    });
    $(".file_remove").on("click", function(e) {
        $("#uploaded_view").removeClass("show");
        $("#uploaded_view").find("img").remove();
        btnOuter.removeClass("file_uploading");
        btnOuter.removeClass("file_uploaded");
        $("#feature").show();
    });
    var csrfToken = "{{ csrf_token() }}";
    $('form#addPostForm').on('submit', function(e) {
        e.preventDefault();
        toastr.remove();
        var post_content = CKEDITOR.instances.post_content.getData();
        var form = this;
        var formData = new FormData(form);
        formData.append('post_content', post_content);
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken, // Send the CSRF token in the request header
            },
            dataType: 'json',
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(response) {
                toastr.remove();
                if (response.code == 1) {
                    $(form)[0].reset();
                    $('#uploaded_view').html(
                        ''); // Corrected selector for clearing the uploaded image view
                    CKEDITOR.instances.post_content.setData('');
                    toastr.success(response.msg);
                } else {
                    toastr.error(response.msg);
                }
            },
            error: function(response) {
                toastr.remove();
                $.each(response.responseJSON.errors, function(prefix, val) {
                    $(form).find('span.' + prefix + '_error').text(val[0]);
                });
            }
        });
    });
</script>
@endsection