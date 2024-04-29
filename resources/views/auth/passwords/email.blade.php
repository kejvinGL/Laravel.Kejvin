@extends('layouts.auth')

@section('content')
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="h-1/5 w-1/2 flex-container justify-center pt-16">
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>
        <div class="error-message" role="alert">
            {{ session('error') }}
        </div>
    </div>
    <div class="flex flex-col justify-evenly h-[400px] w-[500px]">
        <p class="text-2xl text-center">{{ __('Reset Password') }}</p>
        <form class="flex-container justify-evenly h-[200px]" method="POST"
              action="{{ route('password.email') }}">
            @csrf
            <div class="flex flex-col h-1/2 w-3/4">
                <label for="email"
                       class="iconed-input @error('email') input-error @enderror">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="email" type="email" class="grow  "
                           name="email" value="{{ old('email') }}" placeholder="E-mail" required
                           autocomplete="email" autofocus>
                </label>
                @error('email')
                <span class="error-message mt-5" role="alert">
                                        {{ $message }}
                                    </span>
                @enderror

            </div>

            <div class="flex flex-row justify-evenly">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
        <div class="text-right mr-8">
            <a href="/" class="btn btn-primary">< Go Back</a>
        </div>
    </div>
@endsection
