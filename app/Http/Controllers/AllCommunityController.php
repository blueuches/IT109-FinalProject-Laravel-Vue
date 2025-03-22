<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use Inertia\Inertia;

class AllCommunityController extends Controller
{
    public function index()
    {
        $communities = Community::orderBy('name')->get();
        
        return Inertia::render('AllCommunity', compact('communities'));
    }
}
