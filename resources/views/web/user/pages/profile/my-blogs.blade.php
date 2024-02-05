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
          <h1>Your Blogs</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="container-fluid px-4 px-lg-5">
  <div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-12 d-flex justify-content-end mb-5">
      <a href="{{ route('add-blogs') }}" class="btn btn-primary">Create Blog</a>
    </div>
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="example">
        <thead>
          <tr>
            <th>Sl no.</th>
            <th>Title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Published Date</th>
            <th style="width: 20%">#</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blogs as $blog)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $blog->title }}</td>
              <td>{{ Str::limit($blog->content, 25, ' ...') }}</td>
              <td>
                @if ($blog->blog_status == 0)
                  pending
                @elseif($blog->blog_status == 1)
                  Active
                @elseif($blog->blog_status == 2)
                  Rejected
                @endif
              </td>
              <td>
                {{ Carbon\Carbon::parse( $blog->created_at)->format('d/M/Y') }}
              </td>
              <td>
                <a href="{{ route('view-blogs',['blog_id' => $blog->id]) }}" class="btn btn-info p-2 mr-2"><i class="fas fa-eye"></i></a>
                <a href="{{ route('edit-blogs',['blog_id' => $blog->id]) }}" class="btn btn-warning p-2 mr-2"><i class="fas fa-pen"></i></a>
                <button type="button" id="{{ $blog->id }}" name="{{ $blog->id }}" onclick="deleteRecord(this.id,this)" data-token="{{ csrf_token() }}" class="btn btn-danger p-2 mr-2">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@push('body_scripts')
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script>
    var myTable = $('#example').DataTable();
   
    function deleteRecord(blog_id,row_index) {
      var con = confirm("Are you sure you want to delete this Blog ?")
      if(con){
        $.ajax({
          url:"{{ route('delete-blogs') }}",
          type: 'get',
          data: {
            "id": blog_id,
          },
          success: function (data)
          {
            if (data.status == 200) {
              var i = row_index.parentNode.parentNode.rowIndex;
              document.getElementById("example").deleteRow(i);
              toastr.success("Blog Deleted"); 
            } else if(data.status == 400) {
              toastr.error("Blog Failed to Delete");
            }
          }
        });
      } 
    }
  </script>
@endpush