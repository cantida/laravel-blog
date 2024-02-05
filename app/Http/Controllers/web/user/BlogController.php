<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
  function index() {
    $blogs = Blog::orderBy('id', 'DESC')
      ->where('blog_status', 1)
      ->with('user')
      ->get();

    return view('web.user.pages.home.home')
      ->with(compact('blogs'));
  }

  function MyBlogs() {
    $blogs = Blog::orderBy('id', 'DESC')
      ->where('user_id',Auth::user()->id)
      ->get();

    return view('web.user.pages.profile.my-blogs')
      ->with(compact('blogs'));
  }

  function ViewBlogs($blog_id) {

    $blog = Blog::with('user')->find($blog_id);

    if ($blog) {
      return view('web.user.pages.profile.view-blog')
        ->with(compact('blog'));
    } else {
      return abort(404);
    }
  }

  function AddBlogs() {
    return view('web.user.pages.profile.add-blog');
  }

  function CreateBlogs(Request $request) {
    $validator = Validator::make($request->all(), [
      'title'  => 'required|string',
      'content' => 'required|string',
    ]);

    if($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $blog = new Blog($request->all());
    $blog->blog_status = 0;
    $blog->user_id = Auth::user()->id;

    if ($blog->save()) {
      Session::flash('success', 'Blog Created'); 
      return Redirect::route('my-blogs');
    }else {
      return Redirect::back()->with('failed', 'Blog Failed to create'); 
    }
  }

  function EditBlogs($blog_id) {
    
    $blog = Blog::find($blog_id);

    if (Auth::user()->id != $blog->user_id) {
      return abort(404);
    }

    return view('web.user.pages.profile.edit-blog')
      ->with(compact('blog'));
  }

  function UpdateBlogs(Request $request, $blog_id) {
    $validator = Validator::make($request->all(), [
      'title'  => 'required|string',
      'content' => 'required|string',
    ]);

    if($validator->fails()){
      return Redirect::back()->withErrors($validator)->withInput();
    }

    $blog = Blog::find($blog_id);

    if (Auth::user()->id != $blog->user_id) {
      return abort(404);
    }

    $blog->fill($request->all());

    if ($blog->save()) {
      Session::flash('success', 'Blog Updated'); 
      return Redirect::route('my-blogs');
    }else {
      return Redirect::back()->with('failed', 'Blog Failed to Update'); 
    }
  }

  function DeleteBlogs(Request $request) {

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
}
