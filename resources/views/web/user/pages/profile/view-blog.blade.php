@extends('web.user.app')
@push('head_links')

@endpush
@section('content')
<header class="masthead" style="background-image: url('{{ asset('web/user/assets/img/home-bg.jpg') }}')">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="post-heading">
          <h1>{{ $blog->title }}</h1>
          <span class="meta">
            Posted by
            <a href="#!">{{ $blog->user->name }}</a>
            {{ Carbon\Carbon::parse( $blog->created_at)->format('M d, Y') }}
          </span>
        </div>
      </div>
    </div>
  </div>
</header>
<article class="mb-4">
  <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <p>
          {{ $blog->content }}
        </p>
      </div>
    </div>
  </div>
</article>

@endsection
@push('body_scripts')

@endpush