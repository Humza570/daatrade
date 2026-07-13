@extends('layouts.common')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                                <form action="/blogs/search" method="GET">
                                    <input type="text" name="query" placeholder="Search...">
                                    <button type="submit"><span class="icon_search"></span></button>
                                </form>
                            </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="{{ route('blogs') }}">All</a></li>
                                @foreach ($blogCategories as $category)
                                    <li><a href="{{ route('blogs.category',$category->slug) }}">{{ $category->subcategory_name }}
                                            ({{ $category->posts->count() }})
                                        </a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($blogs as $blog)
                                    <a href="{{ route('blogs.details', ['slug' => $blog->post_slug]) }}"  class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{ asset('images/post_images/thumbnails/thumbnail_200x200_' . $blog->featured_image) }}"
                                                alt="Daatrade" width="70">
                                        </div>

                                        <div class="blog__sidebar__recent__item__text">
                                            @php
                                                $titleWords = str_word_count($blog->post_title, 1);
                                                $chunks = array_chunk($titleWords, 4);
                                            @endphp
                                            <h6>
                                                @foreach ($chunks as $chunk)
                                                    {{ implode(' ', $chunk) }}<br>
                                                @endforeach
                                            </h6>
                                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="{{ asset('images/post_images/' . $blog->featured_image) }}"
                                            alt="Daatrade" width="370">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('M d, Y') }}
                                            </li>
                                        </ul>
                                        <h5><a href="{{ route('blogs.details', ['slug' => $blog->post_slug]) }}">{{ $blog->post_title }}</a></h5>
                                        <p>
                                            @php
                                                $contentWords = str_word_count(strip_tags($blog->post_content), 1);
                                                $limitedContent = implode(' ', array_slice($contentWords, 0, 15));
                                                if (count($contentWords) > 15) {
                                                    $limitedContent .= '...';
                                                }
                                                echo $limitedContent;
                                            @endphp
                                        </p>
                                        <a href="{{ route('blogs.details', ['slug' => $blog->post_slug]) }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
