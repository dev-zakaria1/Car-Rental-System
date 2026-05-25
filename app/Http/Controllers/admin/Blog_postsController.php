<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\blog_posts\StoreBlog_postRequest;
use App\Http\Requests\blog_posts\UpdateBlog_postRequest;
use App\Models\blog_post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnArgument;

class Blog_postsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', blog_post::class);
        $posts = blog_post::paginate(10);
        return view('dashboard.blog_post.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', blog_post::class);
        $users = User::all();
        return view('dashboard.blog_post.create', compact('users'));
    }
    public function store(StoreBlog_postRequest $request)
    {

        $blog_post = blog_post::create($request->validated());
        if ($request->hasFile('image')) {
            $fileName = $request->file('image');
            $imageName = $blog_post->id . "." . $fileName->extension();
            $fileName->storeAs('blog_images/', $imageName, 'public');
            $blog_post->update(['image' => $imageName]);
        }
        return redirect()->route('blog_post.index')->with('success', 'blog posts created successfully');
    }
    public function edit(blog_post $blog_post)
    {
        $this->authorize('update', $blog_post);
        $users = User::all();
        return view('dashboard.blog_post.edit', compact('blog_post', 'users'));
    }
    public function update(UpdateBlog_postRequest $request, blog_post $blog_post)
    {
        $validation = $request->validated();

        if ($request->hasFile('image')) {
            if ($blog_post->image) {

                Storage::disk('public')->delete('blog_images/' . $blog_post->image);
            }
            $fileName = $request->file('image');
            $imageName = $blog_post->id . "." . $fileName->extension();
            $fileName->storeAs('blog_images/', $imageName, 'public');
            $validation['image'] = $imageName;
        }
        $blog_post->update($validation);
        return redirect()->route('blog_post.index')->with('success', 'blog posts updated successfully');
    }
    public function delete(blog_post $blog_post)
    {
        $this->authorize('delete', $blog_post);
        if ($blog_post->image) {
            Storage::disk('public')->delete('blog_images/' . $blog_post->image);
        }
        $blog_post->delete();
        return redirect()->route('blog_post.index')->with('success', 'blog is deleted');
    }
}
