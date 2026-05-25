<?php

namespace App\Http\Controllers;

use App\Models\blog_post;
use Illuminate\Http\Request;

class Blog_postsController extends Controller
{
    public function index()
    {
        $blog_posts = blog_post::latest()->where('is_published', true)->paginate(6);
        return view('blog_post.index', compact('blog_posts'));
    }
    public function show(blog_post $blog_post)
    {
        return view('blog_post.show', compact('blog_post'));
    }
}
