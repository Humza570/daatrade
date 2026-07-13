@extends('layouts.admin')
@section('content')
@php
use App\Models\User;
$user=User::where('id',Auth::user()->id)->first();
$role='';
if($user)
{
$role=$user->role;
}
@endphp
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
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
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    @if($role=='admin')
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i>{{$products}}</h1>
                    <h6 class="text-white">Products</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline">{{$vendors}}</i></h1>
                    <h6 class="text-white">Vendors</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-collage">{{$buyers}}</i></h1>
                    <h6 class="text-white">Buyer</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside">{{$members}}</i></h1>
                    <h6 class="text-white">Members</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-arrow-all">{{$membersorder}}</i></h1>
                    <h6 class="text-white">Membership Orders</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i>{{$inquiry}}</h1>
                    <h6 class="text-white">Product Inquiries</h6>
                </div>
            </div>
        </div>

        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-calendar-check">{{$subscriber}}</i></h1>
                    <h6 class="text-white">Subscribers</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-alert">{{$blogcount}}</i></h1>
                    <h6 class="text-white">Blogs</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    @endif
    @if($role=='supplier')
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i>{{$products}}</h1>
                    <h6 class="text-white">Products</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i>{{$inquiry}}</h1>
                    <h6 class="text-white">Product Inquiries</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    @if(isset($user->membership->plan_type))
                    @if ($user->membership->plan_type == '0')
                    <h3 class="font-light text-white"><i class="mdi mdi-receipt"></i>Basic Listing</h1>
                        @elseif ($user->membership->plan_type == '1')
                        <h3 class="font-light text-white"><i class="mdi mdi-receipt"></i>Enhanced Visibility</h1>
                            @elseif ($user->membership->plan_type == '2')
                            <h3 class="font-light text-white"><i class="mdi mdi-receipt"></i>Premium Showcase</h1>
                                @elseif ($user->membership->plan_type == 'free')
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i>Free</h1>
                                @endif
                                @else
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                @endif
                                <a href="https://daatrade.com/membershipplan" target="_blank">
                                    <h6 class="text-white">Upgrade Membership Plans</h6>
                                </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($role=='buyer')
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i>{{$inquiry}}</h1>
                    <h6 class="text-white">Product Inquiries</h6>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Latest Posts</h4>
                </div>
                @foreach($blogs as $blog)
                <div class="comment-widgets scrollable">
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row m-t-0">
                        <div class="p-2"><img src="{{ asset('images/post_images/thumbnails/thumbnail_200x200_' . $blog->featured_image) }}" alt="user" width="50" class="rounded-circle"></div>
                        <div class="comment-text w-100">
                            <h6 class="font-medium">{{$blog->post_title}}</h6>
                            <span class="m-b-15 d-block">
                                @php
                                $contentWords = str_word_count(strip_tags($blog->post_content), 1);
                                $limitedContent = implode(' ', array_slice($contentWords, 0, 15));
                                if (count($contentWords) > 15) {
                                $limitedContent .= '...';
                                }
                                echo $limitedContent;
                                @endphp </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">{{ $blog->created_at->format('M d, Y') }}</span>
                                <a type="button" href="{{ route('blogs.details', ['slug' => $blog->post_slug]) }}" target="_blank" class="btn btn-success btn-sm">View</a>
                                @if($role=='admin')
                                <a type="button" href="{{ route('edit-post', $blog->id) }}" target="_blank" class="btn btn-cyan btn-sm">Edit</a>
                                <a type="button" href="{{ route('delete-post', $blog->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
@endsection