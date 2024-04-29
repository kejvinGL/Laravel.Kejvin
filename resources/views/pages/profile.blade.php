@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50 min-h-screen transition-all main flex-container justify-center active pt-16">
        @php
            if (!session()->has('tab')) {
                session(['tab' => 'avatar']);
            }
        @endphp
        <div class="h-16 flex-container">
            <x-partials.messages.request-responses />
        </div>
        <div class="h-[5vh] mb-5">
            <x-partials.profile.verification-check/>

        </div>
            <div class="flex-container w-[450px] h-[380px]">
                <div role="tablist" class="tabs tabs-lifted">
                    <x-partials.profile.avatar-tab/>
                    <x-partials.profile.details-tab/>
                    <x-partials.profile.password-tab/>
                </div>
            </div>
            <div class="divider w-[500px] mx-auto"></div>
            <x-partials.profile.delete-tab/>

    </main>
@endsection
