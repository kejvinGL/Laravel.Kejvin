@extends('layouts.app')

@section('content')

    <main class="w-full md:ml-64 bg-base-200 h-full transition-all main active pt-16">
        <div class="flex justify-center items-center h-full text-xl">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-header">{{ __('Please, Verify Your Email Address') }}</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-secondary text-xl">{{ __('Click here to request another link') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
