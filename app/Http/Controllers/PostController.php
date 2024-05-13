<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StorePostRequest;
use App\Models\Post;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function dataTable()
    {
        $orders = Post::all();
        return DataTables::of($orders)
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->toDateTimeString();
            })
            ->editColumn('updated_at', function ($order) {
                return Carbon::parse($order->created_at)->toDateTimeString();
            })
            ->editColumn('error_message', function ($order) {
                return $order->error_message ?? "_";
            })
            ->toJson();
    }
    public function index()
    {
        $data = $this->postService->getPostList();
        return view('pages.admin.posts', ['posts' => $data]);
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
