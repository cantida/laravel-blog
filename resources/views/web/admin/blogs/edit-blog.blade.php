@extends('web.admin.app')

@push('head-tags')
  @php
    $page_active = "manage_blogs"
  @endphp
@endpush

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-6">
        <h1 class="m-0">Edit Blog</h1>
      </div>
      <div class="col-6">

      </div>
    </div>
  </div>
</div>
<section class="section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="{{ route('admin-update-blogs',['blog_id' => $blog->id]) }}">
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
                    <div class="col-12 mt-2">
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
      </div>
    </div>
  </div>
</section> 
@endsection
@push('body-tags')
<script>
  var table = $('#data-table').DataTable();
</script> 
@endpush