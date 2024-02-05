<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ManageBlogsController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      if (!Auth::user()->hasRole('admin')) {
        abort(404);
      }
      return $next($request);
    });
  }

  function ManageBlogs()
  {
    $blogs = Blog::orderBy('id', 'DESC')
      ->with('user')
      ->get();

    return view('web.admin.blogs.manage-blog')
      ->with(compact('blogs'));
  }

  function EditBlogs($blog_id)
  {
    $blog = Blog::find($blog_id);

    return view('web.admin.blogs.edit-blog')
      ->with(compact('blog'));
  }

  function UpdateBlogs(Request $request, $blog_id)
  {
    $validator = Validator::make($request->all(), [
      'title'   => 'required|string',
      'content' => 'required|string',
    ]);

    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $blog = Blog::find($blog_id);
    $blog->fill($request->all());

    if ($blog->save()) {
      Session::flash('success', 'Blog Updated');
      return Redirect::route('admin-manage-blogs');
    } else {
      return Redirect::back()->with('failed', 'Blog Failed to Update');
    }
  }

  function DeleteBlogs(Request $request)
  {
    $blog = Blog::find($request->id);

    if ($blog->delete()) {
      return Response::json([
        'status' => 200,
      ]);
    } else {
      return Response::json([
        'status' => 400,
      ]);
    }
  }

  function UpdateBlogStatus(Request $request) {
    
    $blog              = Blog::find($request->blog_id);
    $blog->blog_status = $request->blog_status;

    if ($blog->save()) {
      $status_code = 200; 
    } else {
      $status_code = 400; 
    }

    $blog = Blog::find($request->blog_id);

    return Response::json([
      'status'      => $status_code,
      'blog_status' => $blog->blog_status
    ]);
  }
}
