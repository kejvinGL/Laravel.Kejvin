@extends('layouts.app')

@section('title', 'Post List')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50 min-h-full transition-all main active pt-16">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses />
        </div>
        <table class="table w-full rounded-xl lg:text-lg border-separate border-spacing-2">
            <thead>
            <tr class="border border-accent border-spacing-2 bg-base-300">
                <th class='text-center'>{{__('Poster')}}</th>
                <th class='text-center'>{{__('Title')}}</th>
                <th class='text-center'>{{__('Date Posted')}} </th>
                <th class='text-center'>{{__('Comments')}}</th>
                <th class='text-center'>{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
               <x-partials.post-list.row :$post/>
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
