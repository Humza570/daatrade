@extends('layouts.common')
@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp
<!-- Breadcrumb Section Begin -->
{{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <h2>Vegetable’s Package</h2>
                <div class="breadcrumb__option">
                    <a href="./index.html">Home</a>
                    <a href="./index.html">Vegetables</a>
                    <span>Vegetable’s Package</span>
                </div>
            </div>
        </div>
    </div>
</div>
</section> --}}
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad pt-0">
    <div class="container">

        @if (session('success') && session('sweetAlert'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('
                success ') }}',
            });
        </script>
        @endif

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div style="float: right;">
                    @if($products->vendorname)
                    <div class="product__details__text">
                        <h3>Supplier Name</h3>
                    </div>
                    <p>{{$products->vendorname}}</p>
                    @endif
                    <div class="product__details__text">
                        <h3>Price</h3>
                    </div>
                    @if ($products->price_setting === 'variable')
                    <ul>
                        @foreach ($variablemoq as $index => $variable)
                        <div><b>${{ $variable }} per {{$products->unit}}</b> </div>
                        @endforeach
                    </ul>
                    @elseif ($products->price_setting === 'uniform')
                    <ul>
                        <div style="display: inline-block;"><b>Minimum Order Qauntity:</b> {{ $uniform_moq }} {{$products->unit}}</div>
                        <div><b>{{ $FOBprice }}{{ $uniform_moq_min_price }} per {{$products->unit}} - {{ $FOBprice }}{{ $uniform_moq_max_price }} per {{$products->unit}}</b></div>
                    </ul>
                    @endif
                </div>
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        @php
                        $imagePath = asset('storage/product_images/' . $products->productImages->first()->images);
                        @endphp
                        <img class="product__details__pic__item--large" src="{{ $imagePath }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @foreach ($products->productImages as $image)
                        @php
                        $thumbPath = asset('storage/product_images/' . $image->images);
                        @endphp
                        <img data-imgbigurl="{{ $thumbPath }}" src="{{ $thumbPath }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $products->productname }}</h3>
                </div>
                <div class="blog__details__text">
                    {!! $products->description !!}
                </div>
                <div class="product__details__text">
                    <div class="product__details__price">Composition</div>
                    <ul>
                        @foreach ($products->attribute as $index => $attribute)
                        @if($products->details[$index] !=null && $attribute !=null)
                        <li><b>{{ $attribute }}</b> <span>{{ $products->details[$index] }}</span></li>
                        @endif
                        @endforeach
                    </ul>
                </div>

                <div class="w-100 my-5">
                    <div class="form-group">
                        <button class="site-btn" onclick="checkAndShowModal()">Inquire Now</button>
                    </div>
                </div>
            </div>
            <!-- The Modal -->
            @if(Auth()->check())
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="border-radius: 50px;">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Inquire Now</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" action="{{ route('inquiry') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <div class="form-group row">
                                    <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                                    <div class="col-md-6">
                                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>
                                        @if ($errors->has('subject'))
                                        <div class="error text-danger">{{ $errors->first('subject') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                                    <div class="col-md-6">
                                        <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">
                                        @if ($errors->has('quantity'))
                                        <div class="error text-danger">{{ $errors->first('quantity') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>
                                    <div class="col-md-6">
                                        <textarea rows="5" cols="12" class="form-control" name="message"></textarea>
                                        @if ($errors->has('message'))
                                        <div class="error text-danger">{{ $errors->first('message') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="site-btn">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!--<div class="col-lg-12">-->
            <!--    <div class="product__details__tab">-->
            <!--        <ul class="nav nav-tabs" role="tablist">-->
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"-->
            <!--                    aria-selected="true">Description</a>-->
            <!--            </li>-->
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"-->
            <!--                    aria-selected="false">Information</a>-->
            <!--            </li>-->
            <!--            <li class="nav-item">-->
            <!--                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"-->
            <!--                    aria-selected="false">Reviews <span>(1)</span></a>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--        <div class="tab-content">-->
            <!--            <div class="tab-pane active" id="tabs-1" role="tabpanel">-->
            <!--                <div class="product__details__tab__desc">-->
            <!--                    <h6>Products Infomation</h6>-->
            <!--                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.-->
            <!--                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus-->
            <!--                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam-->
            <!--                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.-->
            <!--                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,-->
            <!--                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a-->
            <!--                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula-->
            <!--                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus-->
            <!--                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam-->
            <!--                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>-->
            <!--                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem-->
            <!--                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet-->
            <!--                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum-->
            <!--                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus-->
            <!--                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.-->
            <!--                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed-->
            <!--                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum-->
            <!--                        sed sit amet dui. Proin eget tortor risus.</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="tab-pane" id="tabs-2" role="tabpanel">-->
            <!--                <div class="product__details__tab__desc">-->
            <!--                    <h6>Products Infomation</h6>-->
            <!--                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.-->
            <!--                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.-->
            <!--                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam-->
            <!--                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo-->
            <!--                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.-->
            <!--                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent-->
            <!--                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac-->
            <!--                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante-->
            <!--                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;-->
            <!--                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.-->
            <!--                        Proin eget tortor risus.</p>-->
            <!--                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem-->
            <!--                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet-->
            <!--                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum-->
            <!--                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus-->
            <!--                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="tab-pane" id="tabs-3" role="tabpanel">-->
            <!--                <div class="product__details__tab__desc">-->
            <!--                    <h6>Products Infomation</h6>-->
            <!--                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.-->
            <!--                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.-->
            <!--                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam-->
            <!--                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo-->
            <!--                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.-->
            <!--                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent-->
            <!--                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac-->
            <!--                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante-->
            <!--                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;-->
            <!--                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.-->
            <!--                        Proin eget tortor risus.</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
{{-- <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('assets/img/product/product-1.jpg') }}">
<ul class="product__item__pic__hover">
    <li><a href="#"><i class="fa fa-heart"></i></a></li>
    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product__item__text">
    <h6><a href="#">Crab Pool Security</a></h6>
    <h5>$30.00</h5>
</div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/product/product-2.jpg') }}">
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6><a href="#">Crab Pool Security</a></h6>
            <h5>$30.00</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/product/product-3.jpg') }}">
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6><a href="#">Crab Pool Security</a></h6>
            <h5>$30.00</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/product/product-7.jpg') }}">
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6><a href="#">Crab Pool Security</a></h6>
            <h5>$30.00</h5>
        </div>
    </div>
</div>
</div>
</div>

</section> --}}
<!-- Update your HTML file with this JavaScript code -->
<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function checkAndShowModal() {
    // Check if the user is logged in
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    if (isLoggedIn) {
        // User is logged in, show the modal
        showModal();
    } else {
        window.location.href = "{{ route('login') }}";
    }
}

function showModal() {
    $('#myModal').modal('show');
}

</script>
<!-- Related Product Section End -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.product__details__pic__slider img').click(function() {
            var largeImageUrl = $(this).data('imgbigurl');
            $('.product__details__pic__item img').attr('src', largeImageUrl);
        });
    });
</script>
@endsection