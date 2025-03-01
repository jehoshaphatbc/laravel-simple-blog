<?php

namespace App\Http\Controllers;

use App\Enums\StatusPost;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $posts = [];

        if (Auth::check()) {
            $posts = Post::with('user')
                ->where('user_id', auth()->user()->id)
                ->orderBy('id', 'asc')->paginate(10);
        }

        return view('home', compact(
            'posts'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->where('status', StatusPost::PUBLISHED->value)
            ->orderBy('id', 'asc')->paginate(10);

        return view('posts.index', compact(
            'posts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allStatus = StatusPost::cases();

        return view('posts.create', compact(
            'allStatus'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;

        $post = Post::create($validatedData);

        return redirect()->route('home')->with('success', 'Post successfully added!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (!Auth::check()) {
            if($post->status == StatusPost::DRAFT || $post->status == StatusPost::SCHEDULE) {
                return redirect()
                    ->route('posts.index');
            }
        }
        return view('posts.show', compact(
            'post'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $allStatus = StatusPost::cases();

        return view('posts.edit', compact(
            'post',
            'allStatus'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;

        $post->update($validatedData);

        return redirect()->route('home')->with('success', 'Post successfully updated!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Post successfully deleted!');
    }
}
