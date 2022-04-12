<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Category;

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

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione
        $request->validate([
            'title' => 'required|string|unique:posts|min:5|max:50',
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'title.required' => 'The title field must be filled',
            'title.unique' => "A post titled '$request->title' was already posted"
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');

        $post = new Post();

        $post->fill($data);
        $post->save();

        return redirect()->route('admin.posts.index')->with('message', 'Post created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validazione
        $request->validate([
            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:5', 'max:50'],
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id'
        ], [
            'title.required' => 'The title field must be filled',
            'title.unique' => "A post titled '$request->title' was already posted"
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id)->with('message', "You have updated '$post->title'")->with('type', 'warning');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "You have deleted '$post->title'")->with('type', 'danger');
    }
}
