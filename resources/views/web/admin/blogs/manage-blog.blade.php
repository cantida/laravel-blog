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
        <h1 class="m-0">Manage Blogs</h1>
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
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered" id="data-table">
                  <thead>
                    <tr>
                      <th>Sl no.</th>
                      <th>Author</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th style="width: 20%"> Manage Status</th>
                      <th>Published Date</th>
                      <th style="width: 20%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($blogs as $blog)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $blog->user->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ Str::limit($blog->content, 25, ' ...') }}</td>
                        <td>
                          <select class="form-control manage_blog_status change_class_{{ $blog->id }}" id="{{ $blog->id }}">
                            <option @if($blog->blog_status == 0) selected @endif value="0">
                              pending
                            </option>
                            <option @if($blog->blog_status == 1) selected @endif value="1">
                              Active
                            </option>
                            <option @if($blog->blog_status == 2) selected @endif value="2">
                              Reject
                            </option>
                          </select>
                        </td>
                        <td>
                          {{ Carbon\Carbon::parse( $blog->created_at)->format('d/M/Y') }}
                        </td>
                        <td>
                          <a href="{{ route('view-blogs',['blog_id' => $blog->id]) }}" class="btn btn-info p-2 mr-2"><i class="fas fa-eye"></i></a>
                          <a href="{{ route('admin-edit-blogs',['blog_id' => $blog->id]) }}" class="btn btn-warning p-2 mr-2"><i class="fas fa-pen"></i></a>
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
        </div>
      </div>
    </div>
  </div>
</section> 
@endsection
@push('body-tags')
<script>
  var table = $('#data-table').DataTable();
  function deleteRecord(blog_id,row_index) {
    var con = confirm("Are you sure you want to delete this Blog ?")
    if(con){
      $.ajax({
        url:"{{ route('admin-delete-blogs') }}",
        type: 'get',
        data: {
          "id": blog_id,
        },
        success: function (data)
        {
          if (data.status == 200) {
            var i = row_index.parentNode.parentNode.rowIndex;
            document.getElementById("data-table").deleteRow(i);
            toastr.success("Blog Deleted"); 
          } else if(data.status == 400) {
            toastr.error("Blog Failed to Delete");
          }
        }
      });
    } 
  }
  $(".manage_blog_status").on("change", function (e) {
    var dynamic_blog_id = this.id;
    var dynamic_blog_status = this.value;
    $.ajax({
      url: "{{ route('admin-update-blog-status') }}",
      type: "get",
      data: {
        blog_id : dynamic_blog_id,
        blog_status : dynamic_blog_status 
      },
      beforeSend: function () {
        $(".change_class_" + dynamic_blog_id + " option").attr('selected', false);
      },
    })
    .done(function (data) {
      $(".change_class_" + dynamic_blog_id + " option[value="+data.blog_status+"]").attr('selected', true); 
      if (data.status == 200) {
        toastr.success("Blog Status Changed"); 
      } else if(data.status == 400) {
        toastr.error("Status Change Failed");
      }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
      alert("Please try again after sometime..");
    });
  })
</script> 
@endpush