@extends('layouts.auth')

@section('title', "Login")

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
    <div class="h-1/5 w-1/2 pt-16">
        <div class="text-red-500 text-lg text-center">
            {{session('error')}}
        </div>
    </div>
    <div class="h-4/5 w-1/2">
        <div class="flex-container justify-between w-full h-[420px]">
            <div class="flex text-xl my-5">
                <p class="flex items-center justify-center text-2xl">{{ __('Login') }}
                </p>
            </div>
            <form method="POST" class="h-3/4 flex flex-col justify-evenly max-w-[500px] w-full"
                  action="{{ route('auth.login') }}">
                @csrf
                <div class="h-1/2">
                    <label for="email"
                           class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope"></i>
                        <input id="email" type="email" class="grow  "
                               name="email" value="{{ old('email') }}" placeholder="E-mail" required
                               autocomplete="email" autofocus>
                    </label>
                    @error('email')
                    <x-partials.messages.error >{{$message}}</x-partials.messages.error>
                    @enderror

                </div>

                <div class="h-1/2">
                    <label
                        class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-key"></i>
                        <input id="password" type="password"
                               class="grow" name="password"
                               placeholder="********" required autocomplete="current-password">
                        @error('password')
                        <x-partials.messages.error >{{$message}}</x-partials.messages.error>
                        @enderror
                    </label>
                </div>

                <div class="flex justify-between">
                    <label class="cursor-pointer label" for="remember">
                        <input class="checkbox checkbox-accent mr-4" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link text-info text-nowrap" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-row justify-between">

                    <button type="submit" class="btn btn-primary w-36">
                        {{ __('Login') }}
                    </button>
                    <div class="divider divider-horizontal">OR</div>
                    <a class="btn w-36" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>

            </form>

        </div>
    </div>
    </div>
@endsection
