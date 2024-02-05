@extends('web.user.app')
@push('head_links')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush
@section('content')
<header class="masthead" style="background-image: url('{{ asset('web/user/assets/img/home-bg.jpg') }}');height: 30vh !important;">
  <div class="container position-relative">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-12">
        <div class="site-heading">
          <h1>Update Blog</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="container px-4 px-lg-5">
  <div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('update-blogs',['blog_id' => $blog->id]) }}">
          @csrf
          <div class="row g-3">
            <div class="col-md-12">
              <label for="your-title" class="form-label">Title</label>
              <input type="text" class="form-control" id="your-title" name="title" value="{{ $blog->title }}" required>
            </div>
            <div class="col-12">
              <label for="your-content" class="form-label">Content</label>
              <textarea class="form-control" id="your-content" name="content" rows="5" required>{{ $blog->content }}</textarea>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-dark w-100 fw-bold" >Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('body_scripts')

@endpush