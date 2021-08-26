<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogTagController;
use App\Http\Controllers\Blog\AdminBlogController;
use App\Http\Controllers\Blog\AdminPostController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\AdminProfileController;

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

// Admin all route


Route::middleware(['auth:admin'])->group(function(){

    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

    Route::get('/admin/logout',[AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminProfileController::class, 'index'])->name('admin.profile');
    Route::get('/admin/profile/edit',[AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile/update',[AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/admin/profile/change-password',[AdminProfileController::class, 'changepassword'])->name('admin.profile.change_password');
    Route::post('/admin/profile/password/update',[AdminProfileController::class, 'passwordupdate'])->name('admin.password.update');



});




// All Main Website Route


/**
 * User Dashboard Route
*/

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/',[IndexController::class, 'index'])->name('index.show');
Route::get('/logout',[UserProfileController::class, 'logout'])->name('user.logout');
Route::get('/user-profile-edit',[UserProfileController::class, 'userprofileedit'])->name('user.profile.edit');
Route::post('/user-profile-update',[UserProfileController::class, 'userprofileupdate'])->name('user.profile.update');
Route::post('/user-password-change',[UserProfileController::class, 'userpasswordchange'])->name('user.password.update');
Route::post('/user-add-address',[UserProfileController::class, 'storeaddress'])->name('user.address.store');
Route::post('/user-update-address',[UserProfileController::class, 'updateaddress'])->name('user.address.update');
Route::get('/user-default-address/{id}',[UserProfileController::class, 'defaultaddress'])->name('address.default');
Route::get('/user-delete-address/{id}',[UserProfileController::class, 'useraddressdelete'])->name('user.delete.address');



/**
 * All blog Fornt End Route
 */


 Route::group(['prefix' => 'blog'], function() {
    Route::get('/',[BlogController::class, 'index'])->name('blog.show');
    Route::get('/latest',[BlogController::class, 'latest'])->name('blog.latest');
    Route::get('/all',[BlogController::class, 'all'])->name('blog.show.all');
    Route::get('/category/{slug:category_name_en_slug}',[BlogController::class, 'category'])->name('blog.category.search');
    Route::post('/tag',[BlogController::class, 'tag'])->name('blog.tag.search');
    Route::post('/search',[BlogController::class, 'search'])->name('blog.search');
    Route::get('/single/{slug:slug}',[BlogController::class, 'single'])->name('blog.single');

 });

 Route::post('/comment',[BlogController::class, 'storecomment']);






// Admin Blog Controller

/**
 * Admin Blog category route Start
 */
    Route::get('admin-category' , [AdminBlogController::class, 'index'])->name('admin.blog.category.show');
    Route::get('admin-categor/all' , [AdminBlogController::class, 'all'])->name('admin.blog.category.all');
    Route::get('admin-categor-trash' , [AdminBlogController::class, 'trashindex'])->name('admin.blog.category.trash.index');
    Route::get('admin-categor/trash' , [AdminBlogController::class, 'trash'])->name('admin.blog.category.trash');
    Route::post('admin-category-store', [AdminBlogController::class, 'store'])->name('admin.blog.category.store');
    Route::get('admin-category-delete/{delete:id}', [AdminBlogController::class, 'moveTrash']);
    Route::get('admin-category-edit/{edit:id}', [AdminBlogController::class, 'edit'])->name('admin.blog.category.edit');
    Route::post('admin-category-update/{update:id}', [AdminBlogController::class, 'update'])->name('admin.blog.category.edit');
    Route::get('recovery/{id}',  [AdminBlogController::class, 'recovery'])->name('cat.recovery');
    Route::get('admin-category-pardelete/{id}',  [AdminBlogController::class, 'destroy']) -> name('cat.force.delete');

/**
 * Admin Blog category route end
 */


 /**
 * Admin Blog tag route Start
 */


 Route::group(['prefix' => 'admin/tag'], function() {
    Route::get('/' , [BlogTagController::class, 'index'])->name('tag.index');
    Route::get('/all' , [BlogTagController::class, 'all'])->name('tag.all');
    Route::get('/trash' , [BlogTagController::class, 'trash'])->name('tag.trash');
    Route::get('/trash-all' , [BlogTagController::class, 'trashAll'])->name('tag.trash.all');
    Route::post('/store' , [BlogTagController::class, 'store'])->name('tag.store');
    Route::get('/move-trash/{trash:id}' , [BlogTagController::class, 'moveTrash'])->name('tag.move.trash');
    Route::get('/restore/{id}' , [BlogTagController::class, 'restore'])->name('tag.restore');
    Route::get('/destory/{id}' , [BlogTagController::class, 'destory'])->name('tag.destory');
    Route::get('/edit/{id:id}' , [BlogTagController::class, 'edit'])->name('tag.edit');
    Route::post('/update/{update:id}' , [BlogTagController::class, 'update'])->name('tag.update');
 });

 /**
 * Admin Blog tag route End
 */




/**
 * Admin Blog Post route Start
*/

Route::group(['prefix' => 'admin/post'], function() {
    Route::get('/' , [AdminPostController::class, 'index'])->name('admin.blog.index');
    Route::get('/all' , [AdminPostController::class, 'all'])->name('admin.blog.all');
    Route::get('/create' , [AdminPostController::class, 'create'])->name('admin.blog.create');
    Route::post('/store' , [AdminPostController::class, 'store'])->name('admin.blog.store');
    Route::get('/trash' , [AdminPostController::class, 'trash'])->name('post.trash');
    Route::get('/trash-all' , [AdminPostController::class, 'trashAll'])->name('post.trash.all');
    Route::get('/move-trash/{trash:id}' , [AdminPostController::class, 'moveTrash'])->name('post.move.trash');
    Route::get('/restore/{id}' , [AdminPostController::class, 'restore'])->name('post.restore');
    Route::get('/destory/{id}' , [AdminPostController::class, 'destory'])->name('post.destory');
    Route::get('/edit/{post:id}' , [AdminPostController::class, 'edit'])->name('post.edit');
    Route::post('/update/{update:id}' , [AdminPostController::class, 'updatepost'])->name('admin.update');
 });


/**
 * Admin Blog post route End
*/
