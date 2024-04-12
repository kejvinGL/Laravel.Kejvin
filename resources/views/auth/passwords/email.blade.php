@extends('layouts.app')

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
    <div class="h-1/5 w-1/2">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="flex flex-col justify-evenly h-[400px] w-[500px]">
        <p class="text-2xl text-center">{{ __('Reset Password') }}</p>
        <form class="flex flex-col items-center justify-evenly h-[200px]" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="flex flex-col h-1/2 w-3/4">
                <label for="email"
                       class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="email" type="email" class="grow  "
                           name="email" value="{{ old('email') }}" placeholder="E-mail" required
                           autocomplete="email" autofocus>
                </label>
                @error('email')
                <span class="label-text-alt text-red-500 mt-5" role="alert">
                                        {{ $message }}
                                    </span>
                @enderror

            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send link via Email') }}
                    </button>
                </div>
            </div>
        </form>
        <div class="text-right mr-8">
        <a href="/" class="btn btn-primary">< Go Back</a>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
