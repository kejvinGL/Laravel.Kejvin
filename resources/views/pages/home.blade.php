@extends('layouts.app')

@section('title', 'My Posts')

@section('content')
    <main class="w-full md:ml-64 bg-base-100/80 h-max transition-all main active mt-16">
        <div class="h-[18vh] flex flex-col align-middle ">
            <dialog id="addNew" class="modal">
                <div class="modal-box">
                    <h3>Creating New Post</h3>
                    <p class="text-xs text-gray-600">Press ESC to cancel</p>
                    <div class="modal-action">
                        <form method="POST" id="add_post" action="{{route('post.store')}}" class="w-full">

                            @csrf
                            <input type="text" name="title" class="input input-bordered w-full"
                                   placeholder="Post title here..">
                            <textarea type name="body" form="add_post"
                                      class="textarea textarea-bordered textarea-lg w-full h-[300px] text-sm mb-2"
                                      placeholder="Type post here..."></textarea>
                            <div class="flex justify-center">
                                <input type="submit" name="submit" class="btn btn-success btn-outline btn-md text-xs"/>
                            </div>
                        </form>
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                    </div>
                </div>
            </dialog>
            <button class="mx-auto btn btn-outline bg-base-100 m-10 h-16 text-xl" onclick="addNew.showModal()">Create
                New<i
                    class="ml-3 fa-solid fa-feather scale-150"></i>
            </button>
        </div>
        <div class="flex flex-col items-center justify-start">
            @if(!$posts->isEmpty())
                @foreach($posts as $post)
                    <x-partials.home.post :$post>
                    </x-partials.home.post>
                @endforeach
            @else
                <h3 class="text-2xl text-center">No posts are made.</h3>
            @endif
        </div>
    </main>

@stop
