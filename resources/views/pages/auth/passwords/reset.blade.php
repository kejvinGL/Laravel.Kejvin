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
            <div class="text-red-500 text-lg text-center">
                {{session('error')}}
            </div>
            <div class="text-red-500 text-lg text-center">
                {{session('message')}}
            </div>
    </div>
    <div class="h-5/6 w-1/2">
        <div class="flex-container justify-between w-full h-[400px]">
            <div class="flex text-xl my-5 h-1/8">
                <p class="flex-container justify-center text-2xl text-nowrap">
                    {{ __('Reset Password') }}
                </p>
            </div>
            <form method="POST" action="{{ route('password.update') }}"
                  class="h-5/6 flex flex-col justify-evenly max-w-[500px] w-full">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="h-1/3">
                    <label for="email"
                           class="iconed-input @error('name') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input id="email" type="text" class="grow"
                               name="email" value="{{ $email ?? old('email') }}" required
                               autocomplete="email"
                               autofocus>
                    </label>
                    @error('name')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
                <div class="h-1/3">
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

                <div class="h-1/3">
                    <label
                        class="iconed-input @error('password') input-error @enderror">
                        <i class="fa-solid fa-key fa-rotate-270"></i>
                        <input id="password-confirm" type="password"
                               class="grow"
                               name="password_confirmation"
                               placeholder="Confirm Password" required
                               autocomplete="new-password">
                    </label>
                    @error('password_confirmation')
                    <span class="error-message" role="alert">
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
        </div>
    </div>
    </div>
@endsection
