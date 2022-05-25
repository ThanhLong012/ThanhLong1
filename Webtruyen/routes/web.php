<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CommentController;


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
Route::group(['prefix' => 'laravel-filemanager' ], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/', [IndexController::class,'index'])->name('index');
Route::get('/load-more',[IndexController::class,'load_more']);
Route::get('/danh-sach/{slug}',[IndexController::class,'danh_sach'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class,'the_loai'])->name('genre');
Route::get('/truyen/{slug}',[IndexController::class,'truyen'])->name('story');
Route::get('/insert-rating',[IndexController::class, 'insert_rating']);
Route::get('/chuong/{story}/{slug}',[IndexController::class,'chapter'])->name('chapter');
Route::get('/tac-gia/{slug}',[IndexController::class,'tac_gia'])->name('author');
Route::post('/tim-kiem', [IndexController::class,'tim_kiem']);

Route::post('/autocomplete-ajax',[IndexController::class,'autocomplete_ajax']);



Route::get('/dang-ky',[IndexController::class,'dang_ky'])->name('register');
Route::post('/dang-ky',[IndexController::class,'store'])->name('register.store');
Route::get('/dang-nhap',[IndexController::class,'dang_nhap'])->name('login.viewer');
Route::post('/dang-nhap',[IndexController::class,'login'])->name('dangnhap');
Route::get('/dang-xuat', [IndexController::class, 'logout'])->name('dangxuat');

// Comment
Route::post('/send-comment',[CommentController::class, 'send_comment']);
Route::post('/reply-comment/{story_id}', [CommentController::class, 'reply_comment'])->name('reply_comment');



Route::get('/admin', [AdminController::class,'index'])->name('home');
Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/error', [AdminController::class, 'error'])->name('login');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('genre', GenreController::class);
    Route::resource('author', AuthorController::class);
    Route::resource('story', StoryController::class);
    Route::resource('chapter', ChapterController::class);

    Route::prefix('chapter')->group(function () {
        Route::get('/', [ChapterController::class, 'index'])->name('chapter.index');
        Route::get('/{slug}', [ChapterController::class, 'show'])->name('chapter.show');
        Route::get('/create/{id}', [ChapterController::class, 'create'])->name('chapter.create');
        Route::post('/create/{id}', [ChapterController::class, 'store'])->name('chapter.store');
        Route::get('/update/{id}', [ChapterController::class, 'edit'])->name('chapter.edit');
        Route::post('/update/{id}', [ChapterController::class, 'update'])->name('chapter.update');
        Route::get('/destroy/{id}', [ChapterController::class, 'destroy'])->name('chapter.destroy');
    });
    
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('information', InformationController::class);

        // Người dùng
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('list.user');
            Route::get('/create', [UserController::class, 'create'])->name('user.add');
            Route::post('/create', [UserController::class, 'store'])->name('user.store');
            Route::get('/update/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });
        // Vai trò
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('list.role');
            Route::get('/create', [RoleController::class, 'create'])->name('role.add');
            Route::post('/create', [RoleController::class, 'store'])->name('role.store');
            Route::get('/update/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });

        //Quyền
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'create'])->name('permission.add');
            Route::post('/create-module', [PermissionController::class, 'create_module']);
            Route::post('/save', [PermissionController::class, 'save'])->name('permission.save');
        });
    });
});
