@extends('frontend.layout.web')

@section('meta')
    <title>{{ $meta->title ?? 'KON KHMER CODE' }}</title>
    <meta name="description"
        content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:title" content="{{ $meta->title ?? 'កូនខ្មែរកូដ' }}">
    <meta property="og:description"
        content="{{ $meta->description ?? 'កូនខ្មែរកូដ ផ្តល់ជូនលោកអ្នកនូវសេវាកម្មល្អឥតខ្ចោះក្នុងការបង្កើតគេហទំព័រផ្លូវការ' }}">
    <meta property="og:image" content="{{ asset($meta->image ?? 'frontend/assets/img/default.jpg') }}">
@endsection

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><b>Search</b></h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>blog</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 entries">
                    <h1>Search Results for "{{ $query }}"</h1>
                    @if ($results['posts']->isNotEmpty())
                    <hr>
                        <h2>Posts</h2>
                        @foreach ($results['posts'] as $post)
                            <div class="card mb-3" style="padding: 20px;">
                                <h3>{{ $post->title }}</h3>
                                <p>{!! Str::limit($post->content, 100) !!}</p>
                                <a class="btn btn-primary" href="{{ route('home.blog.single', $post->id) }}">Read More</a>
                            </div>
                        @endforeach
                    @endif
                    @if ($results['tags']->isNotEmpty())
                    <hr>
                        <h2>Tags</h2>
                        @foreach ($results['tags'] as $tag)
                            <div class="btn btn-primary">{{ $tag->name }}</div>
                        @endforeach
                    @endif

                    {{-- @if ($results['comments']->isNotEmpty())
                        <h2>Comments</h2>
                        @foreach ($results['comments'] as $comment)
                            <div>{{ $comment->content }}</div>
                        @endforeach
                    @endif --}}
                </div>

                <div class="col-lg-4">

                    <div class="sidebar" data-aos="fade-left">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                                <button type="submit"><i class="icofont-search"></i></button>
                            </form>

                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">Categories</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="#">General <span>(25)</span></a></li>
                                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                <li><a href="#">Travel <span>(5)</span></a></li>
                                <li><a href="#">Design <span>(22)</span></a></li>
                                <li><a href="#">Creative <span>(8)</span></a></li>
                                <li><a href="#">Educaion <span>(14)</span></a></li>
                            </ul>

                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Recent Posts</h3>
                        <div class="sidebar-item recent-posts">
                            <div class="post-item clearfix">
                                <img src="{{ asset('frontend/assets/img/blog-recent-posts-1.jpg') }}" alt="">
                                <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('frontend/assets/img/blog-recent-posts-2.jpg') }}" alt="">
                                <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('frontend/assets/img/blog-recent-posts-3.jpg') }}" alt="">
                                <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('frontend/assets/img/blog-recent-posts-4.jpg') }}" alt="">
                                <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="{{ asset('frontend/assets/img/blog-recent-posts-5.jpg') }}" alt="">
                                <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                        </div><!-- End sidebar recent posts-->

                        <h3 class="sidebar-title">Tags</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                {{-- @foreach ($tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</a></li>
                                @endforeach --}}
                            </ul>

                        </div><!-- End sidebar tags-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->
@endsection

@section('style')
    <style>
        .image-container {
            padding: 0 20px;
        }

        #row-img {
            display: flex;
            align-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        ol li {
            font-family: 'battambang';
        }
    </style>
@endsection
