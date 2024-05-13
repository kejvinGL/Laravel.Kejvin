@extends('layouts.auth')

@section('title', "API Payment")

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
    <div class="h-1/5 w-1/2 mt-16">
        <x-partials.messages.request-responses/>
    </div>
    <div class="h-4/5 w-1/3 flex-container">
        <div class="flex text-xl my-5">
            <p class="flex items-center justify-center text-2xl">{{ __('Purchase API Key') }}
            </p>
        </div>
        <form action="{{route('process.transaction')}}" class="h-1/2 flex flex-col w-full" method="get">
            <div class="h-1/3">
                <label for="name"
                       class="input input-bordered flex items-center gap-2 @error('name') input-error @enderror">
                    <i class="fa-solid fa-cloud"></i>
                    <input id="name" type="text" class="grow"
                           name="name" value="{{ old('name') }}" placeholder="API Name" required
                           autocomplete="name" autofocus>
                </label>
                @error('name')
                <x-partials.messages.error>{{$message}}</x-partials.messages.error>
                @enderror
            </div>
            <div class="h-1/3">
                <label for="email"
                       class="input input-bordered flex items-center gap-2 @error('email') input-error @enderror">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="email" type="email" class="grow"
                           name="email" value="{{ old('email') }}" placeholder="E-mail" required
                           autocomplete="email">
                </label>
                @error('email')
                <x-partials.messages.error>{{$message}}</x-partials.messages.error>
                @enderror
            </div>

            <button type="submit" class="btn btn-neutral rounded-3xl w-full text-[18px]" value="">Pay with <i
                    class="fa-brands fa-paypal"></i> PayPal
            </button>
        </form>
    </div>
@endsection
