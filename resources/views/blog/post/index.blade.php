@extends('layouts.app')

@section('content')
<div class="white-space-20"></div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">

                <!-- blog list -->
                <div class="blog-list">

                  @foreach ($posts as $post)
                  <div class="blog-item">
                    <h2 class="blog-title"><a href="blog_single_post.html">{{ $post->title }}<br><small>({{ $post->subtitle }})</small></a></h2>
                    <div class="blog-meta">{{ $post->created_diff }} by <a href="#">{{ $post->user->name }}</a></div>
                    <div class="blog-img">
                      <img src="./assets/theme/images/home-bg.jpg" alt="" class="img-full ">
                      <small>University law school graduate on graduation day. Photo courtesy of Pixabay.</small>
                    </div>
                    <p>{{ $post->content }}</p>
                    <p class="blog-links"><a href="{{ route('blog.show', [$post->slug]) }}" class="btn btn-theme btn-line soft ">Lanjutkan membaca &nbsp; →</a></p>
                  </div>
                  @endforeach

                </div><!-- end blog list -->

                <!-- pager -->
                <nav>
                  <ul class="pager">
                    <li class="previous"><a href="#" class="btn-theme btn-lg"><span aria-hidden="true">←</span> Older</a></li>
                    <li class="next"><a href="#" class="btn-theme btn-lg">Newer <span aria-hidden="true">→</span></a></li>
                  </ul>
                </nav><!-- end pager -->


              </div>
</div>
@endsection
