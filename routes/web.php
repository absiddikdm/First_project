<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorLoginController;
use App\Http\Controllers\AuthorRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontedController::class, 'index'])->name('index');
Route::get('/blog/login',[FrontedController::class, 'author_login'])->name('author.login');
Route::get('author/register',[FrontedController::class, 'author_register'])->name('author.register');
Route::get('/blog/details/{slug}',[FrontedController::class, 'blog_details'])->name('blog.details');
Route::get('/cetegory/blog/{id}',[FrontedController::class, 'cetegory_blog'])->name('cetegory.blog');
Route::get('/author/blog{id}',[FrontedController::class, 'author_blog'])->name('author.blog');
Route::get('/all/blog',[FrontedController::class, 'all_blog'])->name('all.blog');
Route::get('/all/author/list',[FrontedController::class, 'all_author_list'])->name('all.author.list');
Route::get('/tag/blog{id}',[FrontedController::class, 'tag_blog'])->name('tag.blog');


   Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

   Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//user
Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
Route::post('/profile/update',[UserController::class,'profile_update'])->name('profile.update');
Route::get('/user/list',[UserController::class,'user_list'])->name('user.list');
Route::post('/password/update',[UserController::class,'password_update'])->name('password.update');
Route::get('/user/delete/{id}',[UserController::class,'user_delete'])->name('user.delete');
//category
Route::get('/category',[CategoryController::class,'Category'])->name('category');
Route::POST('/category/store',[CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/delete/{id}',[CategoryController::class,'category_delete'])->name('category.delete');
Route::get('/category/trash',[CategoryController::class,'category_trash'])->name('category.trash');
Route::get('/category/permanent/delete{id}',[CategoryController::class,'category_permanent_delete'])->name('category.pdelete');
Route::get('/category/restore/{id}',[CategoryController::class,'category_restore'])->name('category.restore');
Route::Post('/delete/checked',[CategoryController::class,'delete_checked'])->name('delete.checked');
Route::Post('/action/checked',[CategoryController::class,'trash_checked'])->name('trash.checked');

//tags
Route::get('/tag',[TagsController::class,'tag'])->name('tag');
Route::post('/tag/store',[TagsController::class,'tag_store'])->name('tag.store');
Route::get('/tag/delete/{$id}',[TagsController::class,'tag_delete'])->name('tag.delete');

//Author user
Route::POST('/author/register/store', [AuthorRegisterController::class, 'author_register_store'])->name('author.register.store');
 Route::POST('/author.login.confirm', [AuthorLoginController::class, 'author_login_confirm'])->name('author.login.confirm');
 Route::get('/my/profile', [AuthorController::class, 'my_profile'])->name('my.profile');
 Route::get('/my/profile/edit', [AuthorController::class, 'author_profile_edit'])->name('author.profile.edit');
 Route::POST('my/profile/update', [AuthorController::class, 'author_profile_update'])->name('author.profile.update');
 Route::get('/become/author', [AuthorController::class, 'become_author'])->name('become.author');
 Route::get('/author/logout', [AuthorController::class, 'author_logout'])->name('author.logout');

 Route::post('author/request/storer', [AuthorController::class, 'author_request_store'])->name('author.request.store');
 Route::get('author/req/list', [HomeController::class, 'author_req_list'])->name('author.req.list');
 Route::get('author/list', [HomeController::class, 'author_list'])->name('author.list');
 Route::get('author/req/accept/{id}', [HomeController::class, 'req_accept'])->name('req.accept');
 Route::get('author/req/delete/{id}', [HomeController::class, 'req_delete'])->name('req.delete');

 Route::get('author/deactive/{id}', [HomeController::class, 'author_deactive'])->name('author.deactive');
 Route::get('author/del/{id}', [HomeController::class, 'author_del'])->name('author.del');
 Route::post('/author/social/store', [HomeController::class, 'author_social_store'])->name('author.social.store');


//post
Route::get('/add/post', [PostController::class, 'add_post'])->name('add.post');
Route::POST('/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/post/listt', [PostController::class, 'post_list'])->name('post.list');
Route::get('/status/change/{id}', [PostController::class, 'status_change'])->name('status.change');

//subscribe
Route::post('/subscribe/store', [SubscribeController::class, 'subscribe_store'])->name('subscribe.store');
Route::get('/subscribe/list', [SubscribeController::class, 'subscribe_list'])->name('subscribe.list');
Route::get('/subscribe/delete{id}', [SubscribeController::class, 'subs_delete'])->name('subs.delete');
Route::get('/send/subscribe/mail{id}', [SubscribeController::class, 'send_subscribe_mail'])->name('send.subscribe.mail');


//social
Route::get('/social', [SocialController::class, 'social'])->name('social');
Route::post('/social/store', [SocialController::class, 'social_store'])->name('social.store');
Route::get('/social/status/change/{id}', [SocialController::class, 'social_status_change'])->name('social.status.change');
Route::get('/social/delete{id}', [SocialController::class, 'social_delete'])->name('social.delete');
