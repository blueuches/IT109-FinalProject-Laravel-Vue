<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllCommunityResource;
use App\Http\Resources\CommunityResource;
use App\Http\Resources\CommunityPostResource;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search in communities
        $communities = AllCommunityResource::collection(
            Community::where('name', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get()
        );

        // Search in posts
        $posts = CommunityPostResource::collection(
            Post::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->with(['user', 'postVotes' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->withCount('comments')
            ->get()
        );

        return Inertia::render('Frontend/SearchResults', [
            'communities' => $communities,
            'posts' => $posts,
            'query' => $query,
        ]);
    }
}

