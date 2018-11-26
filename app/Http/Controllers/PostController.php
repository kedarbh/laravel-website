<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('management.posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('management.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //validate input
        $this->validate($request, [
            'title' => 'required|min:5|max:255',
            'slug' => 'required|alpha_dash|unique:posts,slug',
            'post_image' => 'image|nullable|max:2048',
            'body' => 'required'
        ]);

        if ($request->hasFile('post_image')) {
            //get original file name
            $originalFileName = $request->file('post_image')->getClientOriginalName();
            //get file name without extension
            $filename = pathinfo($originalFileName, PATHINFO_FILENAME);
            //extract extension of uploaded file
            $ext = $request->file('post_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->image = $fileNameToStore;
        if ($request->has('draft')) {
            $post->status = 0;
        } elseif ($request->has('publish')) {
            $post->status = 1;
        }
        $post->save();

        Session::flash('flash_message', 'New Post Created Successfully.');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('management.posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $post = Post::findOrFail($id);
        return view('management.posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->validate($request, [
            'title' => 'required|min:5|max:255',
            'body' => 'required'
        ]);

        if ($request->hasFile('post_image')) {
            //get original file name
            $originalFileName = $request->file('post_image')->getClientOriginalName();
            //get file name without extension
            $filename = pathinfo($originalFileName, PATHINFO_FILENAME);
            //extract extension of uploaded file
            $ext = $request->file('post_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $fileNameToStore;
        if ($request->has('draft')) {
            $post->status = 0;
        } elseif ($request->has('publish')) {
            $post->status = 1;
        }
        $post->save();

        Session::flash('flash_message', 'Post Updated Successfully.');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //delete a post
        //if post is deleted, remove assigned image as well
        if ($post->image != 'noimage.jpg') {
            Storage::delete('public/images/'.$post->image);
        }
        $package->delete();
        Session::flash('flash_message', 'Post deleted successfully.');
        return redirect('/posts');
    }
}
