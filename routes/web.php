<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\user\BlogController;
use App\Http\Controllers\admin\ManageBlogsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/initial-run', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

Route::get('/db-migrate', function() {
    Artisan::call('migrate');
});

Route::get('/clear-cache', function() {
    Artisan::call('optimize');
});

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('view-blog/{blog_id}', [BlogController::class, 'ViewBlogs'])->name('view-blogs');

Route::group(['middleware' => 'auth' ], function() {
    // User
    Route::get('my-blogs', [BlogController::class, 'MyBlogs'])->name('my-blogs');
    Route::get('add-blog', [BlogController::class, 'AddBlogs'])->name('add-blogs');
    Route::post('create-blog', [BlogController::class, 'CreateBlogs'])->name('create-blogs');
    Route::get('edit-blog/{blog_id}', [BlogController::class, 'EditBlogs'])->name('edit-blogs');
    Route::post('update-blog/{blog_id}', [BlogController::class, 'UpdateBlogs'])->name('update-blogs');
    Route::get('delete-blog', [BlogController::class, 'DeleteBlogs'])->name('delete-blogs');

    //Admin
    Route::get('admin/manage-blogs', [ManageBlogsController::class, 'ManageBlogs'])->name('admin-manage-blogs');
    Route::get('admin/edit-blogs/{blog_id}', [ManageBlogsController::class, 'EditBlogs'])->name('admin-edit-blogs');
    Route::post('admin/update-blogs/{blog_id}', [ManageBlogsController::class, 'UpdateBlogs'])->name('admin-update-blogs');
    Route::get('admin/delete-blogs', [ManageBlogsController::class, 'DeleteBlogs'])->name('admin-delete-blogs');
    Route::get('admin/update-blog-status', [ManageBlogsController::class, 'UpdateBlogStatus'])->name('admin-update-blog-status');
});