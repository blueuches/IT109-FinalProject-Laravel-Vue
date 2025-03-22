<?php

use App\Http\Controllers\AllCommunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Backend\CommunityController;
use App\Http\Controllers\Backend\CommunityPostController;
use App\Http\Controllers\Backend\PostVoteController;
use App\Http\Controllers\Frontend\CommunityController as FrontendCommunityController;
use App\Http\Controllers\Frontend\PostCommentController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileViewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WelcomeController::class,'welcome']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google',[GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('auth/google/callback',[GoogleAuthController::class,'callbackGoogle']);

Route::get('/r/{slug}',[FrontendCommunityController::class, 'show'])->name('frontend.communities.show');
Route::get('/r/{community_slug}/posts/{post:slug}',[PostController::class,'show'])->name('frontend.communities.posts.show');
Route::post('/r/{community_slug}/posts/{post:slug}/comments',[PostCommentController::class,'store'])->name('frontend.posts.comments');
Route::get('/allcommunities',[AllCommunityController::class, 'index'])->name('all-communities');
Route::get('/searchresults', [SearchController::class, 'search'])->name('search');
Route::get('/profile/{username}', [ProfileViewController::class, 'show'])->name('profile.show');
Route::get('/editprofile', [ProfileViewController::class, 'edit'])->name('profile.form');
Route::post('/updatedprofile', [ProfileViewController::class, 'update'])->name('profile.formupdate');


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('/communities', CommunityController::class);
    Route::resource('/communities.posts', CommunityPostController::class);
    Route::post('/posts/{post:slug}/upVote',[PostVoteController::class, 'upVote'])->name('posts.upVote');
    Route::post('/posts/{post:slug}/downVote',[PostVoteController::class, 'downVote'])->name('posts.downVote');
});


require __DIR__.'/auth.php';
