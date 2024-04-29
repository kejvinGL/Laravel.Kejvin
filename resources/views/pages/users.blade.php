@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50  h-full transition-all main active pt-16">

        <div class="h-16 flex-container">
            <x-partials.messages.request-responses />
        </div>

        <table class="table table-auto rounded-xl lg:text-lg border-separate border-spacing-2">
            <thead>
            <tr class="border border-accent border-spacing-2 bg-base-300">
                <th>{{__('Username')}}</th>
                <th>{{__('Full Name')}}</th>
                <th>{{__('Email')}}</th>
                <th class=" hidden md:table-cell">{{__('Last Updated')}}</th>
                <th>{{__('Posts')}}</th>
                <th>{{__('Comments')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <x-partials.user-list.row :$user />
            @endforeach
            </tbody>
        </table>
        <div class="w-full flex justify-center">
            {{$users->links('components.pagination')}}
        </div>
    </main>
@endsection
