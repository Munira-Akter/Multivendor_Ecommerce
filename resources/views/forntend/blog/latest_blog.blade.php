@extends('forntend.layouts.app.main_master')
@section('main')

<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">Blog</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('index.show') }}">
                            Home
                        </a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('blog.show') }}">
                            "Blog"
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card-columns" id="blog_post">

                @foreach ($posts as $post)
                    @php
                    $feature = json_decode($post -> feature);
                    @endphp

                    <div class="card mb-3 overflow-hidden shadow-sm">
                        @if($feature -> post_type == 'Image')
                            <a href="{{ route('blog.single' , $post -> slug ) }}" class="text-reset d-block">
                                <img src="{{ asset('uploads/post/' . $feature -> image) }}"
                                    alt="{{ $post -> title }}"
                                    class="img-fluid ls-is-cached lazyloaded">
                            </a>
                        @endif

                        @if($feature -> post_type == 'Video')
                        <div id="blade_iframe">
                            {!! $feature -> video !!}
                        </div>

                        @endif

                        @if($feature -> post_type == 'Gallery')
                        <div id="slider">
                           <a href="#" class="control_next">&raquo;</a>
                            <a href="#" class="control_prev">&laquo;</a>
                            <ul>
                            @foreach($feature -> gallery as $key => $gallary)
                                <li><img  src="{{ asset('uploads/post/' . $gallary) }}"
                                    alt="{{ $post -> title }}"></li>
                            @endforeach

                            </ul>
                            </div>


                        @endif

                        @if($feature -> post_type == 'Audio')
                        <audio preload="auto" controls>
                            <source src="{{ asset('uploads/post/' . $feature -> audio) }}">
                          </audio>
                        @endif

                        <div class="p-4">
                            <h2 class="fs-18 fw-600 mb-1">
                                <a href="{{ route('blog.single' , $post -> slug ) }}" class="text-reset">
                                    {{ $post -> title }}
                                </a>
                            </h2>
                            <div class="mb-2 opacity-50">
                                @foreach ($post -> categories as $category)
                                    <i>{{ $category -> category_name_en }}</i>
                                @endforeach


                            </div>
                            <p class="opacity-70 mb-4">
                                {{  Str::limit($post -> content, $limit = 50, $end = '...') }}
                            </p>
                            <a href="{{ route('blog.single' , $post -> slug ) }}" class="btn btn-soft-primary">
                                View More
                            </a>
                        </div>
                    </div>





                @endforeach
            </div>

                <div class="aiz-pagination aiz-pagination-center mt-4">
                </div>
            </div>

            @include('forntend.blog.sidebar')
        </div>



    </div>
    </div>
</section>

@endsection()
