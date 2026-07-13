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
            <h4 class="page-title">Edit {{$string}} Page</h4>
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
    <form method="post" action="{{ route('saveaboutpage') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="type" name="type" value="{{$string}}">
        @if($string=='about')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">Welcome</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$about->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <h2 style="color: green;">Timeline</h2>
                        <div class="form-group mb-3">
                            <label for="mission">Our Mission</label>
                            <textarea class="form-control" id="mission" name="mission" rows="5" required>{{$about->mission}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="destination">Your Ultimate Destination</label>
                            <textarea class="form-control" id="destination" name="destination" rows="5" required>{{$about->destination}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="commit">Our Commitment</label>
                            <textarea class="form-control" id="commit" name="commit" rows="5" required>{{$about->commit}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div> 
                        <h2 style="color: green;">Why Choose</h2>
                        <div class="form-group mb-3">
                            <label for="choose1">Global Reach, Local Impact</label>
                            <textarea class="form-control" id="choose1" name="choose1" rows="5" required>{{$about->choose1}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="choose2">Well-Researched Product Categories</label>
                            <textarea class="form-control" id="choose2" name="choose2" rows="5" required>{{$about->choose2}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div> <div class="form-group mb-3">
                            <label for="choose3">Seamless, Fast & Easy Connection</label>
                            <textarea class="form-control" id="choose3" name="choose3" rows="5" required>{{$about->choose3}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="choose4">Verified & Trusted Suppliers</label>
                            <textarea class="form-control" id="choose4" name="choose4" rows="5" required>{{$about->choose4}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div> <div class="form-group mb-3">
                            <label for="choose5">Free to Use</label>
                            <textarea class="form-control" id="choose5" name="choose5" rows="5" required>{{$about->choose5}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="choose6">Secure and Transparent Business Communication</label>
                            <textarea class="form-control" id="choose6" name="choose6" rows="5" required>{{$about->choose6}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>
                    
              <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='privacy')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">Our Privacy Policy</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$privacy->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="mission">Our Terms of Use</label>
                            <textarea class="form-control" id="mission" name="mission" rows="5" required>{{$privacy->mission}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="destination">Privacy Policy</label>
                            <textarea class="form-control" id="destination" name="destination" rows="5" required>{{$privacy->destination}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="commit">Terms to Use</label>
                            <textarea class="form-control" id="commit" name="commit" rows="5" required>{{$privacy->commit}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='faq')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">Frequently Asked Questions</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='benefitbuyer')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">Buyer Benefits</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='benefitsupplier')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">Supplier Benefits</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='registerbuyer')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">How to Register as Buyer</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='registersupplier')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">How to Register as Supplier</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @elseif($string=='inquirybuyer')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="welcome">How to Post your Buying Inquiry</label>
                            <textarea class="form-control" id="welcom" name="welcome" rows="5" required>{{$faq->welcome}}</textarea>
                            <span class="text-danger error-text post_content_error"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>

<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('commit');
            CKEDITOR.replace('mission');
            CKEDITOR.replace('welcome');
            CKEDITOR.replace('destination');
            CKEDITOR.replace('choose1');
            CKEDITOR.replace('choose2');
            CKEDITOR.replace('choose3');
            CKEDITOR.replace('choose4');
            CKEDITOR.replace('choose5');
            CKEDITOR.replace('choose6');
        });
    </script>


@endsection