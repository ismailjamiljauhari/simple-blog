<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Post::query()
            ->whereNotNull('publish_at')
            ->whereDate('publish_at', '<=', now()->format('Y-m-d'))
            ->whereTime('publish_at', '<=', now()->format('H:i:s'));

        if (!is_null($category = request()->category)) {
            $query = $query->where('category', $category);
        }

        $data['posts'] = $query->get();

        return view('frontend.post.index', $data);
    }

    /** 
     * Get Detail Post
     * 
     * @param string $slug
     */
    public function detailPost($slug = '')
    {
        $data['object'] = Post::whereSlug($slug)->firstOrFail();

        return view('frontend.post.detail', $data);
    }
}
