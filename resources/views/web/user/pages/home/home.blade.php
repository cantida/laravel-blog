@extends('web.user.app')
@push('head_links')

@endpush
@section('content')
<header class="masthead" style="background-image: url('{{ asset('web/user/assets/img/home-bg.jpg') }}')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="site-heading">
          <h1>Laravel Blogs</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="container px-4 px-lg-5">
  <div class="row gx-4 gx-lg-5">
    @foreach ($blogs as $blog)
      <div class="col-md-6">
        <!-- Post preview-->
        <div class="post-preview">
          <a href="{{ route('view-blogs',['blog_id' => $blog->id]) }}">
            <h2 class="post-title">{{ $blog->title }}</h2>
            <h3 class="post-subtitle">{{ Str::limit($blog->content, 50, ' ...') }}</h3>
          </a>
          <p class="post-meta">
            Posted by
            <strong>{{ $blog->user->name }}</strong>
            {{ Carbon\Carbon::parse( $blog->created_at)->format('M d, Y') }}
          </p>
        </div>
      </div>
    @endforeach
  </div>
</div> 
@endsection
@push('body_scripts')

@endpush