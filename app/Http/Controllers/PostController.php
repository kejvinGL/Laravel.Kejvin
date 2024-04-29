<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Models\Post;
use App\Services\MediaService;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;


class PostController extends Controller
{
    public function __construct(private PostService $postService, private MediaService $mediaService)
    {
    }

    public function index()
    {
        $data = $this->postService->getPostList();
        return view('pages.posts', ['posts' => $data]);
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        try {
            $this->postService->store($request->validated());
            return back()->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Post could not be created.');
        }
    }

    public function destroy(Post $post)
    {
        try {
            $this->postService->destroy($post, false);
            return back()->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Post could not be deleted.');
        }
    }



}
