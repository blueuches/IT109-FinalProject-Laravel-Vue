<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommunityPostResource;
use App\Http\Resources\CommunityResource;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome(){
        $posts = CommunityPostResource::collection(Post::with(['user','community','postVotes'=>function($query){
            $query->where('user_id',Auth::id());
        }])->withCount('comments')->orderBy('votes','desc')->take(12)->get());

        $communities = CommunityResource::collection(Community::withCount('posts')->orderBy('posts_count','desc')->take(6)->get());

        return Inertia::render('Welcome', compact('posts','communities'));
    }
}
