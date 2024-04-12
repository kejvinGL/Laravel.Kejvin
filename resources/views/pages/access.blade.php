@extends('layouts.app')

@section('title', 'Post List')

@section("content")
    <main
        class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-base-200 min-h-screen transition-all main flex flex-col justify-center items-center active">
        <div class="px-10 pb-5 min-w-[350px] lg:min-w-[400px] h-20">
            @if(session('success'))
                <div class="alert label-text-alt text-green-500 text-lg text-center">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="bg-base-300 px-10 pb-5 min-w-[350px] lg:min-w-[400px] h-2/5 min-h-[360px]">
            <form id="register-form" action="{{route("admin.create")}}" method="post"
                  class="h-full flex flex-col justify-evenly max-w-[500px] w-full">
                <div class="flex h-1/5 items-center justify-center">
                    <p class=" text-center text-xl my-5">Create a new</p>

                    <select name="role" class="select select-ghost outline-0 text-xl bg-base-300 px-4">
                        <option value="1" selected>Admin</option>
                        <option value="2">Client</option>
                    </select>
                </div>

                @csrf
                <div class="h-4/5 flex flex-col justify-evenly">
                    <label
                        class="input input-bordered flex items-center gap-2 @error('name') input-error @enderror">
                        <i class="fa-solid fa-id-card fa-sm" style="opacity: 0.7;"></i>
                        <input name="name" type="text" class="grow" placeholder="Full Name"
                               value="{{old('name') }}"/>
                    </label>
                    @error('name')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                    <label
                        class="input input-bordered flex items-center gap-2  @error('email') input-error @enderror">
                        <i class="fa-solid fa-envelope"></i>
                        <input name="email" type="email" class="grow" placeholder="E-mail"
                               value="{{old('email') }}"/>
                    </label>
                    @error('email')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                    <label
                        class="input input-bordered flex items-center gap-2 @error('username') input-error @enderror">
                        <i class="fa-solid fa-user"></i>
                        <input name="username" type="text" class="grow" placeholder="Username"
                               value="{{old('username') }}"/>
                    </label>
                    @error('username')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <label
                        class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-key"></i>
                        <input name="password" type="password" class="grow" placeholder="********"/>
                    </label>
                    @error('password')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                    <label
                        class="input input-bordered flex items-center gap-2 @error('password') input-error @enderror">
                        <i class="fa-solid fa-key fa-rotate-270"></i> <input id="password-confirm" type="password"
                                                                             class="grow" name="password_confirmation"
                                                                             placeholder="******** (confirm)" required
                                                                             autocomplete="new-password">
                    </label>
                    @error('password')
                    <span class="label-text-alt text-red-500" role="alert">
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
            <span class="label-text-alt text-red-500" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </main>
@endsection
