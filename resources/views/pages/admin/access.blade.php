@extends('layouts.app')

@section('title', 'Post List')

@section("content")
    <main class="w-full md:ml-64 bg-base-200/50 min-h-screen transition-all main flex-container justify-center">
        <div class="px-10 pb-5 min-w-[350px] lg:min-w-[400px] h-20">
                <x-partials.messages.request-responses />
        </div>
        <div class="bg-base-100 border border-neutral px-10 pb-5 min-w-[350px] lg:min-w-[400px] h-2/5 min-h-[360px]">
            <form id="register-form" action="{{route("admin.user.create")}}" method="post"
                  class="h-full flex-container justify-evenly max-w-[500px] w-full">
                @csrf
                <div class="flex h-1/5 items-center justify-center">
                    <p class=" text-center text-xl my-5">Create a new</p>

                    <select name="role" class="select select-ghost outline-0 text-xl text-accent pr-8">
                        <option value="1" selected>{{__('Admin')}}</option>
                        <option value="2">{{__('Client')}}</option>
                    </select>
                </div>

                <div class="h-4/5 flex-container justify-evenly">
                    <label
                        class="iconed-input @error('name') input-error @enderror">
                        <i class="fa-solid fa-id-card fa-sm" style="opacity: 0.7;"></i>
                        <input name="name" type="text" class="grow" placeholder="{{__('Full Name')}}"
                               value="{{old('name') }}"/>
                    </label>
                    @error('name')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                    <label
                        class="iconed-input  @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope"></i>
                        <input name="email" type="email" class="grow" placeholder="E-mail"
                               value="{{old('email') }}"/>
                    </label>
                    @error('email')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                    <label
                        class="iconed-input @error('username') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input name="username" type="text" class="grow" placeholder="Username"
                               value="{{old('username') }}"/>
                    </label>
                    @error('username')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <label
                        class="iconed-input @error('password') input-error @enderror">
                        <i class="fa-solid fa-key"></i>
                        <input name="password" type="password" class="grow" placeholder="********"/>
                    </label>
                    @error('password')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <label
                        class="iconed-input @error('password') input-error @enderror">
                        <i class="fa-solid fa-key fa-rotate-270"></i> <input id="password-confirm" type="password"
                                                                             class="grow" name="password_confirmation"
                                                                             placeholder="******** (confirm)" required
                                                                             autocomplete="new-password">
                    </label>
                    @error('password')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </form>

        </div>
        <div class="text-center mt-8 w-[300px]">
            <input type="submit" class="btn btn-outline w-5/12" name="submit" form="register-form" value="Register">
        </div>
        <div class="flex justify-center">
            @error('name')
            <span class="error-message" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </main>
@endsection
