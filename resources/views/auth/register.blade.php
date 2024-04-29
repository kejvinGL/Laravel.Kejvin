@extends('layouts.auth')

@section('title', "Register")

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
    <div class="h-1/6 w-1/2">
        @if(session('error'))
            <div class="text-red-500 text-lg text-center">
                {{session('error')}}
            </div>
        @endif
    </div>
    <div class="h-5/6 w-1/2">
        <div class="flex-container justify-between w-full h-[660px]">
            <div class="flex text-xl my-5 h-1/8">
                <p class="flex-container justify-center text-2xl">{{ __('Register') }}
                </p>
            </div>
            <form method="POST" class="h-5/6 flex flex-col justify-evenly max-w-[500px] w-full"
                  action="{{ route('auth.register') }}">
                @csrf

                <div class="h-1/5">
                    <label for="name"
                           class="iconed-input @error('name') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input id="name" type="text" class="grow"
                               name="name" value="{{ old('name') }}" placeholder="Name" required
                               autocomplete="name" autofocus>
                    </label>
                    @error('name')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5"><label for="username"
                                          class="iconed-input @error('username') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input id="name" type="text" class="grow"
                               name="username" value="{{ old('username') }}" placeholder="Username" required
                               autocomplete="username">
                    </label>
                    @error('username')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label for="email"
                           class="iconed-input @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope"></i>
                        <input id="email" type="email" class="grow"
                               name="email" value="{{ old('email') }}" placeholder="E-mail" required
                               autocomplete="email">
                    </label>
                    @error('email')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label
                        class="iconed-input @error('password') input-error @enderror">
                        <i class="fa-solid fa-key"></i>
                        <input id="password" type="password"
                               class="grow" name="password"
                               placeholder={{__("Password")}} required autocomplete="new-password">
                    </label>
                    @error('password')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label
                        class="iconed-input @error('password') input-error @enderror">
                        <i class="fa-solid fa-key fa-rotate-270"></i>
                        <input id="password-confirm" type="password"
                               class="grow" name="password_confirmation"
                               placeholder="Confirm Password" required
                               autocomplete="new-password">
                    </label>
                    @error('password_confirmation')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="flex flex-row justify-between">
                    <button type="submit" class="btn btn-primary w-36">
                        {{ __('Register') }}
                    </button>

                    <div class="divider divider-horizontal">OR</div>
                    <a class="btn w-36" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            </form>
        </div>
    </div>

@endsection
