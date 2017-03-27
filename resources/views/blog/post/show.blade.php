@extends('layouts.app')

@section('heading')
  @include('partials.title')
@stop

@section('content')
<div class="container">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="blog-list">

                  <!-- blog details -->
                  <div class="blog-item">

                    <h2 class="blog-title"><a href="{{ url()->current() }}" >{{ $post->title }} <br/>
                    @if ($post->subtitle)
                    <small>({{ $post->subtitle }})</small>
                    @endif
                    </a></h2>
                    <div class="blog-meta">{{ $post->created_diff }} by <a href="#">{{ $post->user->name }}</a></div>

                    @if (! empty($blog->images))
                    <div class="blog-img">
                      <img src="./assets/theme/images/home-bg.jpg" alt="" class="img-full ">
                      <small >University law school graduate on graduation day. Photo courtesy of Pixabay.</small>
                    </div>
                    @endif

                    {!! $post->content !!}


                    <div class="blog-desc-bottom">
                      <!-- tags -->
                      <p class="blog-tags clearfix">
                        <span class="space-inline-100">@lang('blog.post.tag')</span>
                        <a href="#" class="btn btn-line soft btn-theme btn-xs">education</a>
                        <a href="#" class="btn btn-line soft btn-theme btn-xs">tips</a>
                        <a href="#" class="btn btn-line soft btn-theme btn-xs">advise</a>
                        <a href="#" class="btn btn-line soft btn-theme btn-xs">consent</a>
                      </p><!-- end tags -->

                      <!-- share icons -->
                      <p class="socials  no-margin">
                        <span class="space-inline-100">@lang('blog.post.share')</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}.&hashtags=blog,glosarium"><i class="fa fa-twitter"></i></a>
                        <a href="https://plus.google.com/share?url={{ url()->current() }}"><i class="fa fa-google-plus"></i></a>
                      </p><!-- end share icons -->

                      <!-- blog post profile -->
                      <div class="media post-comment post-profile-blog clearfix">
                        <div class="media-left post-profile ">
                          <img class="media-object" alt="{{ $post->user->name }}" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?s=124">
                        </div>
                        <div class="media-body">
                          <div class="post-desc-comment no-margin">
                            <strong>Tentang</strong>
                            <h5 class="no-margin-top">{{ $post->user->name }}</h5>
                            <p>{{ $post->user->about }}</p>
                          </div>
                        </div>
                      </div><!-- end blog post profile -->

                      <!-- list comments -->
                      @include('partials.disqus', ['slug' => $post->slug])
                      <!-- end list comments -->

                    </div>
                  </div><!-- end blog details -->



                </div>

                <!-- pager -->
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="{{ route('blog.index') }}" class="btn-theme"><span aria-hidden="true" class="hidden-xs">&larr;</span> @lang('blog.post.btn.backIndex')</a></li>
                  </ul>
                </nav> <!-- end pager -->
              </div>
            </div>
          </div>
@endsection
