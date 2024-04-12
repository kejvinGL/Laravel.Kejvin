@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200 min-h-screen transition-all main flex flex-col items-center justify-center active">
        @php
            if (!session()->has('tab')) {
                session(['tab' => 'avatar']);
            }
        @endphp
        <div class="h-[5vh] mb-5">
            @if(session('success'))
                <div class="alert label-text-alt text-green-500 text-lg text-center">
                    {{ session('success') }}
                </div>
            @endif
        </div>
            <div class="flex flex-col items-center w-[450px] h-[380px]">
                <div role="tablist" class="tabs tabs-lifted">
                    <x-partials.profile.avatarTab></x-partials.profile.avatarTab>
                    <x-partials.profile.detailsTab></x-partials.profile.detailsTab>
                    <x-partials.profile.passwordTab></x-partials.profile.passwordTab>
                </div>
            </div>
            <div class="divider w-[500px] mx-auto"></div>
            <x-partials.profile.deleteTab></x-partials.profile.deleteTab>

    </main>
@endsection
