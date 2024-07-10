<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->id();

        Comment::create($data);

        return redirect()->route('posts.show', ['post' => $post])
            ->with('message', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        $post = Post::where('id', $comment->post_id)->first();

        return redirect()->route('posts.show', ['post' => $post])
            ->with('message', 'Comment deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $post = Post::where('id', $comment->post_id)->first();
        $comment->delete();

        return redirect()->route('posts.show', ['post' => $post])
            ->with('message', 'Comment deleted successfully.');
    }
}
