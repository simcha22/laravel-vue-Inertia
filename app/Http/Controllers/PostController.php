<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Attachment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $posts = Post::with(['user'])->latest()->get();
        return Inertia::render('Posts/Index',
            ['posts' => PostResource::collection($posts)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): \Inertia\Response
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $files = $data['files'] ?? [];
        $post = Post::create($data);

        if ($files) {
            foreach ($files as $file) {
                $directory = 'post/' . Str::random(32);
                Storage::makeDirectory($directory);
                $model = [
                    'attachmentable_id' => $post->id,
                    'attachmentable_type' => Post::class,
                    'name' => $file->getClientOriginalName(),
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                    'path' => $file->store($directory, 'public'),
                ];
                Attachment::create($model);
            }
        }
        $posts = PostResource::collection(Post::with(['user', 'attachment'])->latest()->get());

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'flash' => ['success' => 'Post created successfully!'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', ['post' => new PostResource($post)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', ['post' => new PostResource($post)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return Inertia::render('Posts/Show',
            [
                'post' => new PostResource($post),
                'flash' => ['success' => 'Post created successfully!'],
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        $posts = PostResource::collection(Post::with(['user'])->latest()->get());

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'flash' => ['success' => 'Post Delete successfully!'],
        ]);
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->user()->id)->with(['user'])->latest()->get();
        return Inertia::render('Posts/Index',
            ['posts' => PostResource::collection($posts)]);
    }
}
