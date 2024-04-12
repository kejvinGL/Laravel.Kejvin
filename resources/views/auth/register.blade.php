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
    <div class="h-1/6 w-1/2">
    </div>
    <div class="h-5/6 w-1/2">
        <div class="flex flex-col items-center justify-between w-full h-[660px]">
            <div class="flex text-xl my-5 h-1/8">
                <p class="flex items-center justify-center text-2xl">{{ __('Register') }}
                </p>
            </div>
            <form method="POST" class="h-5/6 flex flex-col justify-evenly max-w-[500px] w-full"
                  action="{{ route('register') }}">
                @csrf

                <div class="h-1/5">
                    <label for="name"
                           class="input input-bordered flex items-center gap-2 @error('name') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input id="name" type="text" class="grow"
                               name="name" value="{{ old('name') }}" placeholder="Name" required
                               autocomplete="name" autofocus>
                    </label>
                    @error('name')
                    <span class="label-text-alt text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5"><label for="username"
                            class="input input-bordered flex items-center gap-2 @error('username') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input id="name" type="text" class="grow"
                               name="username" value="{{ old('username') }}" placeholder="Username" required
                               autocomplete="username">
                    </label>
                    @error('username')
                    <span class="label-text-alt text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label for="email"
                            class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope"></i>
                        <input id="email" type="email" class="grow"
                               name="email" value="{{ old('email') }}" placeholder="E-mail" required
                               autocomplete="email">
                    </label>
                    @error('email')
                    <span class="label-text-alt text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label
                        class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-key"></i>
                        <input id="password" type="password"
                               class="grow" name="password"
                               placeholder="Password" required autocomplete="new-password">
                    </label>
                    @error('password')
                    <span class="label-text-alt text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/5">
                    <label
                        class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-key fa-rotate-270"></i> <input id="password-confirm" type="password"
                                                                             class="grow" name="password_confirmation"
                                                                             placeholder="Confirm Password" required
                                                                             autocomplete="new-password">
                    </label>
                    @error('password_confirmation')
                    <span class="label-text-alt text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="flex flex-row justify-evenly">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                    @if (Route::has('login'))
                        <div class="divider divider-horizontal">OR</div>
                        <li class="btn btn-link">
                            <a class="btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
