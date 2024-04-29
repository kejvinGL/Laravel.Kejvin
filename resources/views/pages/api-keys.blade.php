@extends('layouts.app')

@section('title', 'API Keys')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50  h-full transition-all main active pt-16">
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses/>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <x-partials.messages.error >{{$error}}</x-partials.messages.error>
                @endforeach
            @endif
        </div>
        <div class="h-[18vh] flex-container align-middle ">
            <button class="mx-auto btn rounded-md bg-base-100 m-10 h-16 text-xl" onclick="create_api_key.showModal()">
                {{__('Create')}} <i class="ml-3 fa-solid fa-key scale-150"></i>
            </button>
        </div>
        <x-partials.api-list.modals.create-api-key/>
        <table class="table table-auto rounded-xl lg:text-lg border-separate border-spacing-2">
            <thead>
            <tr class="border border-accent border-spacing-2 bg-base-300">
                <th>{{__('API Name')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Key')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($keys as $key)
                <x-partials.api-list.row :$key/>
            @endforeach
            </tbody>
        </table>
        <div class="w-full flex justify-center">
            {{$keys->links('components.pagination')}}
        </div>
    </main>
@endsection
