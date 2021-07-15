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
@php
$feature = json_decode($post -> feature);
@endphp

<section class="pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card text-left">
                    @if($feature -> post_type == 'Image')
                    <a href="{{ route('blog.single' , $post -> slug ) }}" class="text-reset d-block">
                        <img style="width:100%; height:500px;" src="{{ asset('uploads/post/' . $feature -> image) }}"
                            alt="{{ $post -> title }}" class="img-fluid ls-is-cached lazyloaded">
                    </a>
                    @endif

                    @if($feature -> post_type == 'Video')
                    <div id="single_iframe">
                        {!! $feature -> video !!}
                    </div>

                    @endif

                    @if($feature -> post_type == 'Gallery')
                    <div id="slider">
                        <a href="#" class="control_next">&raquo;</a>
                        <a href="#" class="control_prev">&laquo;</a>
                        <ul>
                            @foreach($feature -> gallery as $key => $gallary)
                            <li><img src="{{ asset('uploads/post/' . $gallary) }}"
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

                    <div class="card-body">
                        <h4 class="card-title">{{ $post -> title }}</h4>
                        <div class="border-bottom"></div>

                        <div class="">
                            <div class="mb-2 opacity-50">
                                @foreach ($post -> categories as $category)
                                <span class="my-2 d-inline-block" style="font-weight: 600; padding-right:10px;"><a
                                        href="{{route('blog.category.search' , $category -> category_name_en_slug )}}">{{ $category -> category_name_en }}</a></span>
                                @endforeach

                                <span> | {{ $post -> created_at -> diffForHumans() }}</span>
                                <span> | By <a href="">{{ $post -> user -> name }}</a> </span>

                            </div>
                            <p class="card-text" style="font-size: 14px; line-height:28px; padding: 0px 0px 30px 0px;">
                                {{ $post -> content }}</p>

                            <div class="post-block mt-5 post-share">
                                <h4 class="mb-3">Share this Post</h4>

                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style d-flex">
                                    <a class="addthis_button_facebook_like at300b" fb:like:layout="button_count">
                                        <div class="fb-like fb_iframe_widget" style="height: 25px;"
                                            data-layout="button_count" data-show_faces="false" data-share="false"
                                            data-action="like" data-width="90" data-height="25" data-font="arial"
                                            data-href="https://www.okler.net/previews/porto/9.0.0/blog-post.html"
                                            data-send="false" fb-xfbml-state="rendered"
                                            fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=https%3A%2F%2Fwww.okler.net%2Fpreviews%2Fporto%2F9.0.0%2Fblog-post.html&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90">
                                            <span style="vertical-align: bottom; width: 90px; height: 28px;"><iframe
                                                    name="f2ee0566516ab42" data-testid="fb:like Facebook Social Plugin"
                                                    title="fb:like Facebook Social Plugin" allowtransparency="true"
                                                    allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                                    style="border: medium none; visibility: visible; width: 90px; height: 28px;"
                                                    src="https://www.facebook.com/v2.6/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df33e86c2bc5df24%26domain%3Dwww.okler.net%26origin%3Dhttps%253A%252F%252Fwww.okler.net%252Ff233722a69305c4%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=https%3A%2F%2Fwww.okler.net%2Fpreviews%2Fporto%2F9.0.0%2Fblog-post.html&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90"
                                                    class="" width="90px" height="25px" frameborder="0"></iframe></span>
                                        </div>
                                    </a>
                                    <a class="addthis_button_tweet at300b">
                                        <div class="tweet_iframe_widget" style="width: 62px; height: 25px;">
                                            <span><iframe id="twitter-widget-0" scrolling="no" allowtransparency="true"
                                                    allowfullscreen="true"
                                                    class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                                    style="position: static; visibility: visible; width: 61px; height: 20px;"
                                                    title="Twitter Tweet Button"
                                                    src="https://platform.twitter.com/widgets/tweet_button.06c6ee58c3810956b7509218508c7b56.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=https%3A%2F%2Fwww.okler.net%2Fpreviews%2Fporto%2F9.0.0%2Fblog-post.html&amp;size=m&amp;text=Post%20Full%20Width%20%7C%20Porto%20-%20Responsive%20HTML5%20Template%3A&amp;time=1625784055648&amp;type=share&amp;url=https%3A%2F%2Fwww.okler.net%2Fpreviews%2Fporto%2F9.0.0%2Fblog-post.html%23.YOd-9SuyZHc.twitter"
                                                    __idm_frm__="141733920776"
                                                    data-url="https://www.okler.net/previews/porto/9.0.0/blog-post.html#.YOd-9SuyZHc.twitter"
                                                    frameborder="0"></iframe></span></div>
                                    </a>
                                </div>

                                <div class="post-block mt-4 pt-2 post-author">
                                    <h4 class="mb-3">Author</h4>
                                    <div class="img-thumbnail img-thumbnail-no-borders d-block pb-3 float-left mr-3">
                                        <a href="blog-post.html">
                                            <img style="width: 80px; height:80px; border-radius:4px;" src="{{ (!empty($post -> user -> profile_photo_path )) ? url('uploads/admin/' . $post -> user -> profile_photo_path):url('uploads/avatar.jpg')}}" alt="">
                                        </a>
                                    </div>
                                    <p><strong class="name"><a href="#" class="text-4 pt-2 d-block">{{ $post -> user -> name }}</a></strong></p>
                                    <p>{{ $post -> user -> email }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card text-left">
                    <div class="card-body">
                        <div id="comments" class="post-block mt-5 post-comments">
                            <h4 class="mb-3">Comments (3)</h4>

                            <ul class="comments">
                                <li>
                                    <div class="comment">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block ">
                                            <img class="avatar" alt="" src="{{ asset('uploads/avatar.jpg') }}">
                                        </div>
                                        <div class="comment-block">
                                            <div class="comment-arrow"></div>
                                            <span class="comment-by">
                                                <strong>John Doe</strong>
                                                <span class="float-end">
                                                    <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                </span>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                                            <span class="date float-end">January 12, 2021 at 1:38 pm</span>
                                        </div>
                                    </div>

                                    <ul class="comments reply">
                                        <li>
                                            <div class="comment">
                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                    <img class="avatar" alt="" src="{{ asset('uploads/avatar.jpg') }}">
                                                </div>
                                                <div class="comment-block">
                                                    <div class="comment-arrow"></div>
                                                    <span class="comment-by">
                                                        <strong>John Doe</strong>
                                                        <span class="float-end">
                                                            <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                        </span>
                                                    </span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                    <span class="date float-end">January 12, 2021 at 1:38 pm</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="comment">
                                                <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                                    <img class="avatar" alt="" src="{{ asset('uploads/avatar.jpg') }}">
                                                </div>
                                                <div class="comment-block">
                                                    <div class="comment-arrow"></div>
                                                    <span class="comment-by">
                                                        <strong>John Doe</strong>
                                                        <span class="float-end">
                                                            <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                        </span>
                                                    </span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
                                                    <span class="date float-end">January 12, 2021 at 1:38 pm</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                            <img class="avatar" alt="" src="{{ asset('uploads/avatar.jpg') }}">
                                        </div>
                                        <div class="comment-block">
                                            <div class="comment-arrow"></div>
                                            <span class="comment-by">
                                                <strong>John Doe</strong>
                                                <span class="float-end">
                                                    <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                </span>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <span class="date float-end">January 12, 2021 at 1:38 pm</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment">
                                        <div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
                                            <img class="avatar" alt="" src="{{ asset('uploads/avatar.jpg') }}">
                                        </div>
                                        <div class="comment-block">
                                            <div class="comment-arrow"></div>
                                            <span class="comment-by">
                                                <strong>John Doe</strong>
                                                <span class="float-end">
                                                    <span> <a href="#"><i class="fas fa-reply"></i> Reply</a></span>
                                                </span>
                                            </span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <span class="date float-end">January 12, 2021 at 1:38 pm</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="card text-left">
                  <div class="card-body">
                    <h4 class="card-title" style="padding: 20px 35px;">Place Your Comment Here</h4>

                        @auth
                    <form class="contact-form p-4 rounded bg-color-grey" id="user_comment_form" action="" method="POST">
                        @csrf
                            <div class="p-2">
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label required font-weight-bold text-dark">Comment</label>
                                        <textarea name="comment"  data-msg-required="Please enter your message." rows="8" class="form-control"  ></textarea>
                                    @error('comment')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col mb-0">
                                        <input type="submit" value="Post Comment" class="btn btn-primary btn-modern" data-loading-text="Loading...">
                                    </div>
                                </div>
                            </div>

                        </form>
                        @else
                        <form class="contact-form p-4 rounded bg-color-grey" id="comment_form">
                            @csrf
                            <div class="p-2">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label required font-weight-bold text-dark">Full Name</label>
                                        <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" >
                                    @error('name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label required font-weight-bold text-dark">Email Address</label>
                                        <input type="email" value="" data-msg-required="Please enter your email address." maxlength="100" class="form-control" name="email" >
                                    @error('email')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label required font-weight-bold text-dark">Comment</label>
                                        <textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control" name="comment" ></textarea>
                                        @error('comment')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col mb-0">
                                        <button type="submit" value="Post Comment" class="btn btn-primary btn-modern">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endauth

                  </div>
                </div>

                <div class="aiz-pagination aiz-pagination-center mt-4">
                </div>
            </div>


            @include('forntend.blog.sidebar')
        </div>
    </div>



    </div>
    </div>
</section>

@endsection()
