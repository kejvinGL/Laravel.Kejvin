@extends('layouts.app')

@section('title', 'Post List')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50 h-full transition-all main">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses />
        </div>
        <table class="table table-auto rounded-xl lg:text-lg border-separate border-spacing-2">
            @include('components.post-list.header')
            <tbody>
            @foreach($posts as $post)
                @include('components.post-list.row')
            @endforeach
            </tbody>
        </table>
        <div class="w-full flex justify-center">
            {{$posts->links('components.pagination')}}
        </div>
        @if (empty($posts))
            <h3 class="w-full m-10 text-center text-3xl">No posts are made.</h3>
        @endif
    </main>
@endsection
