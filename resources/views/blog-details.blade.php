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
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="img/blog/details/details-pic.jpg" alt="Daatrade">
                        <img src="{{ asset('images/post_images/' . $blog->featured_image) }}" alt="Daatrade" width="100%">
                        {!! $blogs[0]->post_content !!}
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/details-author.jpg" alt="Daatrade">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Michael Scofield</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                <ul>
                                        <li><span>Categories:</span>  @foreach ($blogCategories as $category)
                                        @if($category->id== $blogs[0]->category_id)
                                        {{ $category->subcategory_name }}
                                        @endif
                                        
                                @endforeach</li>
                                        @php
                                        $tags = unserialize($blogs[0]->keywords);
                                        @endphp
                                        <li><span>Tags:</span> {{ implode(', ', $tags) }}</li>
                                    </ul>
                                    {{-- <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    {{-- <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Post You May Like</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="Daatrade">
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
                            <img src="img/blog/blog-2.jpg" alt="Daatrade">
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
                            <img src="img/blog/blog-3.jpg" alt="Daatrade">
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
    </section> --}}
    <!-- Related Blog Section End -->
@endsection
