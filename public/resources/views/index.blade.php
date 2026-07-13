@extends('layouts.common')

@section('content')
<style>
    .categories__item h5 {
        display: flex;
        height: 125px;
        background-color: rgba(0, 0, 0, 0.63);
        position: absolute;
        left: 0;
        width: 100%;
        padding: 10px 20px;
        bottom: 0px;
        text-align: center;
        color: #fff;
        font-size: 16px;
        align-items: center;
        justify-content: center;
    }
</style>


{{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}"
style="background-image: url('{{ asset('assets/img/breadcrumb.jpg') }}');">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <h2>Daatrade</h2>
                <div class="breadcrumb__option">
                    <a href="/">Empowering B2B Connections</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section> --}}

<!-- Categories Section Begin -->
<section class="categories mt-3">
    <div class="container">
        <div class="row" style="margin-left: 300px;">
            <div class="categories__slider owl-carousel">
                @foreach ($products as $product)
                @if ($product->productImages->isNotEmpty())
                @php
                $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
                @endphp
                @endif
                <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset($imagePath) }}">
                            <h5 class="product-name">{{ $product->productname }}</h5>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
<!-- Featured Section Begin -->

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Top Exports</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                        <li data-filter=".topexport{{ $category->id }}">{{ $category->category }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($topproducts as $product)
            @if ($product->productImages->isNotEmpty())
            @php
            $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
            @endphp
            <div class="product__item__pic set-bg" data-setbg="{{ asset($imagePath) }}">
            </div>
            @else
            <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/default-image.jpg') }}">
            </div>
            @endif
            <div class="col-lg-3 col-md-4 col-sm-6 mix topexport{{ $product->category_id }} fresh-meat">
                <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset($imagePath) }}">
                            {{-- <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    </ul> --}}
                        </div>
                        <div class="featured__item__text">
                            <h6>{{ $product->productname }}</h6>
                            </a>
                            @php
                        $variablemoq = null;
                        $variableprice = null;
                        $uniform_moq = null;
                        $FOBprice = null;
                        $uniform_moq_min_price = null;
                        $uniform_moq_max_price = null;

                        if ($product->price_setting === 'variable') {
                        $variablemoq = unserialize($product->variablemoq);
                        $variableprice = unserialize($product->variableprice);
                        } elseif ($product->price_setting === 'uniform') {
                        $uniform_moq = $product->uniform_moq;
                        $FOBprice = $product->FOBprice;
                        $uniform_moq_min_price = $product->uniform_moq_min_price;
                        $uniform_moq_max_price = $product->uniform_moq_max_price;
                        }
                        @endphp
                            @if ($product->price_setting === 'variable')
                            <ul>
                                @foreach ($variablemoq as $index => $variable)
                                <div><b>${{ $variable }} per {{$product->unit}}</b> </div>
                                @endforeach
                            </ul>
                            @elseif ($product->price_setting === 'uniform')
                            <ul>
                                <div style="display: inline-block;">Min. Order: {{ $uniform_moq }} {{$product->unit}}</div>
                                <div style="display: inline-block;"><b>{{ $FOBprice }}{{ $uniform_moq_min_price }} per {{$product->unit}} - {{ $FOBprice }}{{ $uniform_moq_max_price }} per {{$product->unit}}</b></div>
                            </ul>
                            @endif
                            @if($product->vendorname)
                            <a>{{$product->vendorname}}</a>
                            @endif
                            @if(isset($product->user->membership_id))
                              @if($product->user->membership->plan_type==0)
                              <img src="{{ asset('assets/img/Badge-01.png') }}"  class="circle-image" alt="Badge">
                             @elseif($product->user->membership->plan_type==1)
                             <img src="{{ asset('assets/img/Badge-2.png') }}"  class="circle-image" alt="Badge">
                             @elseif($product->user->membership->plan_type==2)
                             <img src="{{ asset('assets/img/Badge-03.png') }}"  class="circle-image" alt="Badge">
                              @endif
                            @endif
                            <br>
                            <button class="site-btn" onclick="checkAndShowModal({{$product->id}})">Inquire Now</button>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->
<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('assets/img/banner/ban-1.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('assets/img/banner/ban-2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                        $products = \App\Models\Product::orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();
                        $productChunks = $products->chunk(3); // Products ko 3-3 ke chunks mein divide karein
                        @endphp

                        @foreach ($productChunks as $chunk)
                        <div class="latest-prdouct__slider__item">
                            @foreach ($chunk as $product)
                            @php
                            $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
                            @endphp
                            <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset($imagePath) }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->productname }}</h6>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                        $products = \App\Models\Product::where('featured', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();
                        $productChunks = $products->chunk(3); // Products ko 3-3 ke chunks mein divide karein
                        @endphp

                        @foreach ($productChunks as $chunk)
                        <div class="latest-prdouct__slider__item">
                            @foreach ($chunk as $product)
                            @php
                            $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
                            @endphp

                            <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset($imagePath) }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->productname }}</h6>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">

                        @php
                        $products = \App\Models\Product::where('featured', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();
                        $productChunks = $products->chunk(3); // Products ko 3-3 ke chunks mein divide karein

                        // Shuffle each chunk
                        $productChunks->each(function ($chunk) {
                        $chunk->shuffle();
                        });
                        @endphp

                        @foreach ($productChunks as $chunk)
                        <div class="latest-prdouct__slider__item">
                            @foreach ($chunk as $product)
                            @php
                            $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
                            @endphp

                            <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset($imagePath) }}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->productname }}</h6>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endforeach

                    </div>
                </div>
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
                                <input type="hidden" name="product_id" id="product_id">
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
</section>
<script>
    function checkAndShowModal(id) {
    // Check if the user is logged in
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

    if (isLoggedIn) {
        // User is logged in, show the modal
        showModal(id);
    } else {
        window.location.href = "{{ route('login') }}";
    }
}

function showModal(productId) {
    $('#product_id').val(productId);
    $('#myModal').modal('show');
}

</script>
<!-- Latest Product Section End -->

<!-- Blog Section Begin
                                <section class="from-blog spad">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="section-title from-blog__title">
                                                    <h2>From The Blog</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="blog__item">
                                                    <div class="blog__item__pic">
                                                        <img src="{{ asset('assets/img/blog/blog-1.jpg') }}" alt="">
                                                    </div>
                                                    <div class="blog__item__text">
                                                        <ul>
                                                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                            <li><i class="fa fa-comment-o"></i> 5</li>
                                                        </ul>
                                                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                                                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="blog__item">
                                                    <div class="blog__item__pic">
                                                        <img src="{{ asset('assets/img/blog/blog-2.jpg') }}" alt="">
                                                    </div>
                                                    <div class="blog__item__text">
                                                        <ul>
                                                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                            <li><i class="fa fa-comment-o"></i> 5</li>
                                                        </ul>
                                                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                                                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="blog__item">
                                                    <div class="blog__item__pic">
                                                        <img src="{{ asset('assets/img/blog/blog-3.jpg') }}" alt="">
                                                    </div>
                                                    <div class="blog__item__text">
                                                        <ul>
                                                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                            <li><i class="fa fa-comment-o"></i> 5</li>
                                                        </ul>
                                                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                                                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                -->
<!-- Blog Section End -->
<script>
    $(document).ready(function() {
        $(".product-name").each(function() {
            var $div = $(this);
            var maxWidth = $div.width();
            var maxHeight = $div.height();
            var text = $div.text();
            var words = text.split(' ');
            var lines = [];
            var currentLine = "";
            for (var i = 0; i < words.length; i++) {
                var testLine = currentLine + words[i] + ' ';
                var testWidth = $div.html(testLine).width();
                
                if (testWidth > maxWidth && i > 0) {
                    lines.push(currentLine);
                    currentLine = words[i] + ' ';
                } else {
                    currentLine = testLine;
                }
            }
            lines.push(currentLine);
            $div.html(lines.join('<br>'));
            // Trim text if it exceeds maxHeight
            if ($div.height() > maxHeight) {
                var truncatedText = $div.text();
                while ($div.height() > maxHeight) {
                    truncatedText = truncatedText.slice(0, -1);
                    $div.text(truncatedText + '...');
                }
            }
        });
   
    });
</script>
@endsection