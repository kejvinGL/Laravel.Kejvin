@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <main class="w-full md:ml-64 bg-base-200 h-full transition-all main active mt-16">
        <div class="h-10 flex justify-center">
            @if(session('success'))
                <div class="text-green-500 text-lg text-center">
                    {{ session('success') }}
                </div>
            @endif
            @error('delete_password')
            <div class="text-red-500 text-lg text-center">
                {{ $message }}
            </div>
            @enderror
        </div>

    <table class="table table-auto rounded-xl lg:text-lg border-separate border-spacing-2">
        <thead>
        <tr class="border border-accent border-spacing-2 bg-base-300">
            <th class="hidden md:table-cell">Avatar</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th class=" hidden md:table-cell">Last Login</th>
            <th>Posts</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="border-b border-accent border-spacing-2">
                <!-- USER AVATAR -->
                <td class="hidden md:table-cell w-1/12 pr-0">
                    <div class="flex items-center gap-0 justify-center">
                        <div>
                                <img src="{{$user['avatar']}}" class="size-8"/>
                            </div>
                        </div>

                </td>

                <!-- FULL NAME -->
                <td class="bg-base-100 text-center">
                    <div>
                        <div class>{{$user['name']}}</div>
                    </div>
                </td>

                <!-- USERNAME & BADGE -->
                <td class="bg-base-100 text-center">
                    <div>
                        @if($user["role_id"] == 2)
                            <div >{{$user['username']}}</div>
                        @else
                            <div class="indicator w-full h-full">
                                <span class="indicator-item indicator-start badge badge-warning scale-50">Admin</span>
                                <div class="w-full">{{$user['username'] }}</div>
                            </div>
                        @endif
                    </div>
                </td>

                <!-- EMAIL -->
                <td class="bg-base-100 pr-0 md:pr-1">
                    <div>
                        <div class="text-xs text-wrap">{{$user['email']}}</div>
                    </div>
                </td>
                <!-- LAST LOGIN -->
                <td class="bg-base-100 hidden md:table-cell text-center">
                    {{\Carbon\Carbon::parse($user['last_login'])->format('d/m/y @ H:i')}}
                </td>
                <!-- POSTS -->
                <td class="bg-base-100 text-center ">
                    {{$user["role_id"] == 2 ? $user['posts'] : " _"}}
                </td>
                <!-- ACTIONS -->
                <td class="bg-base-100 text-nowrap p-1 text-center ">
                    <button class="btn btn-accent btn-xs rounded-md mx1"
                            onclick="{{"edit_user_" . $user["id"] }}.showModal()">
                        <i class="fa-solid fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-error btn-xs rounded-md mx1" onclick="{{ 'delete_user_' . $user['id'] }}.showModal()">
                        <i class="fa-solid fa-trash"></i> Del
                    </button>
                    <dialog id="{{"edit_user_" . $user["id"] }}" class="modal">
                        <div class="modal-box">
                            <h3><span class="text-red-500">WARNING! </span>Editing User Information</h3>
                            <p class="text-xs text-gray-600">Press ESC to cancel</p>
                            <div class="modal-action">
                                <form method="POST" action="{{route('admin.edit', $user['id'])}}" id="edit_user" class="w-full">
                                    @method('put')
                                    @csrf
                                    <label class="input input-bordered flex items-center gap-2">
                                        <i class="fa-solid fa-user"></i>
                                        <input name="new_username" class="grow " type="text" placeholder="Username"
                                               value={{$user['username']}} minlength="5" required/>
                                    </label>
                                    <label class="input input-bordered flex items-center gap-2 w-full">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input name="new_email" class="grow" type="email" placeholder="Email"
                                               value="{{$user['email']}}" required/>
                                    </label>
                                    <div class="flex justify-center">
                                        <input type="submit" name="edit"
                                               class="btn btn-error btn-outline btn-md text-xs" value="Save Changes"/>
                                    </div>
                                </form>
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <dialog id="{{ 'delete_user_' . $user['id'] }}" class="modal">
                        <div class="modal-box">
                            <h3><span class="text-red-500">WARNING! </span>Deleting a user: {{ $user['fullname'] }} ({{ '@' . $user['username'] }})</h3>
                            <p class="text-xs text-gray-600">Press ESC to cancel</p>
                            <div class="modal-action flex flex-col">
                                <form id="delete_form" class="inline-flex join" action="{{route('admin.user.destroy',$user['id'] )}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input type="password" name="delete_password" class="input input-bordered join-item w-full max-w-xs" id="enter_pass" placeholder="********"/>
                                    <input type="submit" name="delete" class="btn btn-outline join-item btn-error" id="deleteButton" value="Delete"/>
                                </form>
                                <form method="dialog">
                                    <button class="btn">Close</button>
                                </form>
                            </div>
                        </div>
                    </dialog>

                </td>
            </tr>
        @endforeach
        </tbody>
</table>
    </main>
@endsection
