@extends('layouts.app')

@section('title', 'Post List')

@section('content')

    <main class="w-full md:ml-64 bg-base-200 min-h-full transition-all main active">
    <div class="flex h-14 justify-center items-center">
    </div>
    <table class="table rounded-xl lg:text-lg border-separate border-spacing-2">
        <thead>
        <tr class="border border-accent border-spacing-2 bg-base-300">
            <th class="bg-base-200 hidden md:table-cell"></th>
            <th class='text-center'>Poster</th>
            <th class='text-center'>Title</th>
            <th class='text-center'>Date Posted</th>
            <th class='text-center'>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr class="border-b border-accent border-spacing-2">
                <!-- USER AVATAR -->
                <td class="bg-base-100 hidden md:table-cell w-1/12 pr-0">
                    <div class="text-center">
                        <div class="avatar">
                            <div class="mask mask-squircle size-6">
                                <img src="{{ $post['avatar'] }}" alt="avatar">
                            </div>
                        </div>
                    </div>
                </td>

                <!-- USERNAME -->
                <td class="bg-base-100 pr-0 md:pr-1 text-center">
                    <div>
                        {{ $post['poster'] }}
                    </div>
                </td>
                <!-- TITLE -->
                <td class="bg-base-100 pr-0 text-center w-5/12 md:pr-1">
                    <div>
                        {{ $post['title'] }}
                    </div>
                </td>

                <!-- DATE CREATED -->
                <td class="bg-base-100 text-center">
                    {{ \Carbon\Carbon::parse($post['created_at'])->format('H:i @ d/m/y') }}
                </td>
                <td class="bg-base-100 text-center">
                    <dialog id="post_{{ $post['id'] }}" class="modal ">
                        <div class="modal-box p-10 text-start">
                            <p >{{ $post['title'] }}</p>
                            <div class="divider" ></div>
                            <p class="text-sm text-gray-400">{{ $post['body'] }}</p>
                            <div class="modal-action">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <button class="btn btn-info btn-xs rounded-md" onclick="document.getElementById('post_{{ $post['id'] }}').showModal()">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <dialog id="delete_post_{{ $post['id'] }}" class="modal">
                        <div class="modal-box">
                            <h3>Are you sure you want to delete this Post?</h3>
                            <p class="text-xs text-gray-600">Press ESC to cancel</p>
                            <div class="modal-action">
                                <form method="post" action=" {{ route('post.destroy', $post['id']) }} " class="w-full">
                                    @method('DELETE')
                                    @csrf
                                    <div class="flex justify-center">
                                        <input type="submit" name="delete" class="btn btn-error btn-outline btn-md text-xs" value="Delete" />
                                    </div>
                                </form>
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <button class="btn btn-error btn-xs rounded-md" onclick="document.getElementById('delete_post_{{ $post['id'] }}').showModal()">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if (empty($posts))
        <h3 class="w-full m-10 text-center text-3xl">No posts are made.</h3>
    @endif
    </main>
@endsection
