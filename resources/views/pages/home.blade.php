@extends('layouts.app')

@section('title', 'My Posts')

@section('content')
    <main class="w-full md:ml-64 bg-base-200/50 min-h-screen h-max transition-all main active pt-16">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses/>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <x-partials.messages.error >{{$error}}</x-partials.messages.error>
                @endforeach
            @endif
        </div>
        <div class="h-[18vh] flex-container align-middle ">
            <button class="mx-auto btn rounded-md bg-base-100 m-10 h-16 text-xl" onclick="create_post.showModal()">
                {{__('Create')}} <i class="ml-3 fa-solid fa-key scale-150"></i>
            </button>
        </div>
        <x-partials.home.create-post />
        <div class="flex-container w-1/3 gap-8 mx-auto">
            @if($posts->count() !== 0)
                @foreach($posts as $post)
                    <x-partials.home.post :$post>
                    </x-partials.home.post>
                @endforeach
            @else
                <h3 class="text-2xl text-center">No posts are made.</h3>
            @endif
        </div>
        <div class="w-full flex justify-center">
            {{$posts->links('components.pagination')}}
        </div>
    </main>

@stop
