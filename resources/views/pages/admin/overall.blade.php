@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')
    <main class="w-full min-h-max md:w-[calc(100%-256px)] md:ml-64 bg-base-200/50 h-full transition-all main pt-16">
        <div class="h-16 flex-container justify-center">
            <x-partials.messages.request-responses />
        </div>
        <div class="p-5 flex-container">
            <div class="grid grid-cols-1 md:grid-cols-2 w-3/4 gap-6 mb-6">
                <div class="stat bg-base-100">
                    <div class="stat-figure text-secondary pr-3">
                        <i class="fa-regular fa-user fa-2xl"></i>
                    </div>
                    <div class="stat-title">{{__('Total Clients')}}</div>
                    <div class="stat-value">{{ $data['totalClients'] }}</div>
                </div>
                <div class="stat bg-base-100">
                    <div class="stat-figure text-secondary pr-3">
                        <i class="fa-solid fa-hammer fa-2xl"></i>
                    </div>
                    <div class="stat-title">{{__('Total Admins')}}</div>
                    <div class="stat-value">{{ $data['totalAdmins'] }}</div>
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 mb-6 w-3/4">
                <div class="stat bg-base-100">
                    <div class="stat-figure text-secondary pr-3">
                        <i class="fa-solid fa-inbox fa-2xl"></i>
                    </div>
                    <div class="stat-title">{{__('Total Number of Posts')}}</div>

                    <div class="stat-value">{{$data['totalPosts']}}</div>
                    <div class="stat-desc">{{$data['recentPosts']}} (last 24h)</div>
                </div>
            </div>

        </div>
    </main>
@stop
