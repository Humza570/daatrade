@extends('layouts.common')
@section('content')
@php
use Illuminate\Support\Facades\Storage;
@endphp
{{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
                <h2>Organi Shop</h2>
                <div class="breadcrumb__option">
                    <a href="./index.html">Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
</section> --}}
<!-- Product Section Begin -->
<section class="product spad mt-1 pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('categories.products', ['id' => $category->id]) }}">{{ $category->category }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset('assets/img/latest-product/lp-1.jpg') }}" alt="">
                </div>
                <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                </div>
                </a>
                <a href="#" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="img/latest-product/lp-2.jpg" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>Crab Pool Security</h6>
                        <span>$30.00</span>
                    </div>
                </a>
                <a href="#" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="img/latest-product/lp-3.jpg" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>Crab Pool Security</h6>
                        <span>$30.00</span>
                    </div>
                </a>
            </div>
            <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="img/latest-product/lp-1.jpg" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>Crab Pool Security</h6>
                        <span>$30.00</span>
                    </div>
                </a>
                <a href="#" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="img/latest-product/lp-2.jpg" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>Crab Pool Security</h6>
                        <span>$30.00</span>
                    </div>
                </a>
                <a href="#" class="latest-product__item">
                    <div class="latest-product__item__pic">
                        <img src="img/latest-product/lp-3.jpg" alt="">
                    </div>
                    <div class="latest-product__item__text">
                        <h6>Crab Pool Security</h6>
                        <span>$30.00</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div> --}}
    </div>
    </div>
    <div class="col-lg-9 col-md-7">
        {{-- <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Products</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-1.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Raisin’n’nuts</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-2.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Vegetables</span>
                                        <h5><a href="#">Vegetables’package</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-3.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Mixed Fruitss</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-4.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Raisin’n’nuts</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-5.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Raisin’n’nuts</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-6.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Raisin’n’nuts</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

        <div class="section-title product__discount__title">
            <h2>Products</h2>
        </div>
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Sort By</span>
                        <select>
                            <option value="0">Default</option>
                            <option value="0">Default</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="filter__found">
                        <h6><span>{{ $productscount }}</span> Products found</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="filter__option">
                        <span class="icon_grid-2x2"></span>
                        <span class="icon_ul"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
            <a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
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
                        @if ($product->productImages->isNotEmpty())
                        @php
                        $imagePath = 'storage/product_images/' . $product->productImages->first()->images;
                        @endphp
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($imagePath) }}">
                        </div>
                        @else
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('assets/img/default-image.jpg') }}"></div>
                        @endif
                        <div class="product__discount__item__text">
                            <span>
                                @if ($product->category_id && $product->sub_category_id)
                                {{ $product->subCategory->subcategory }}
                                ({{ $product->category->category }})
                                @elseif ($product->category_id)
                                {{ $product->category->category }}
                                @elseif ($product->sub_category_id)
                                {{ $product->subCategory->subcategory }}
                                @endif

                            </span>
                            <h5><a href="{{ route('products.details', ['slug' => $product->slug, 'uniqueidentifier' => $product->id]) }}">{{ $product->productname }}</a></h5>
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
            </a>
            @endforeach
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
<!-- Product Section End -->
@endsection