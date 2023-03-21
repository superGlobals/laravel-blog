@extends('front.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Welcome to LaraBlog')

@section('content')
    <div class="row">
        <div class="col-12">
            {{-- <div class="breadcrumbs mb-4"> <a href="index.html">Home</a>
                <span class="mx-1">/</span> <a href="#!">Articles</a>
                <span class="mx-1">/</span> <a href="#!">Travel</a>
            </div> --}}
            <h1 class="mb-4 border-bottom border-primary d-inline-block">{{ $pageTitle }}</h1>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                @forelse ($posts as $item)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{ route('read-post', $item->post_slug) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ date_formatter($item->created_at) }}</span>
                                        <span
                                            class="text-uppercase">{{ readDuration($item->post_title, $item->post_content) }}
                                            @choice('min|mins', readDuration($item->post_title, $item->post_content)) read</span>
                                    </div>
                                    <img loading="lazy" decoding="async"
                                        src="/storage/images/post_images/{{ $item->featured_image }}" alt="Post Thumbnail"
                                        class="w-100" width="420" height="280">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li> <a href="#!">travel</a>
                                        <a href="#!">news</a>
                                    </li>
                                </ul>
                                <h2><a class="post-title"
                                        href="{{ route('read-post', $item->post_slug) }}">{{ $item->post_title }}</a></h2>
                                <p class="card-text">{!! Str::ucfirst(words($item->post_content, 12)) !!}</p>
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('read-post', $item->post_slug) }}">Read Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <span class="text-danger">No post(s) found</span>
                @endforelse
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        {{ $posts->appends(request()->input())->links('custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget-blocks">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget">
                            <div class="widget-body">
                                <img loading="lazy" decoding="async" src="images/author.jpg" alt="About Me"
                                    class="w-100 author-thumb-sm d-block">
                                <h2 class="widget-title my-3">Hootan Safiyari</h2>
                                <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter, Developer and Story
                                    teller. Working as a Content writter at CoolTech Agency. Quam nihil …</p> <a
                                    href="about.html" class="btn btn-sm btn-outline-primary">Know
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Latest Posts</h2>
                            <div class="widget-body">
                                <div class="widget-list">
                                    @foreach (latest_sidebar_post() as $item)
                                        <a class="media align-items-center" href="{{ route('read-post', $item->post_slug) }}">
                                            <img loading="lazy" decoding="async" src="/storage/images/post_images/thumbnails/thumb_{{ $item->featured_image }}"
                                                alt="Post Thumbnail" class="w-100">
                                            <div class="media-body ml-3">
                                                <h3 style="margin-top:-5px">{{ $item->post_title }}</h3>
                                                <p class="mb-0 small">{!! Str::ucfirst(words($item->post_content, 10)) !!}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-categories-list />
                    <x-tags-list />

                </div>
            </div>
        </div>
    </div>
@endsection
