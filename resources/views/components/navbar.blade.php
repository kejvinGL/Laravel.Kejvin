<nav class="fixed navbar bg-base-100 top-0 z-10 ">
    <div class="flex-1">
        @auth
            <button type="button" class="text-lg text-neutral-400 size-10 btn btn-ghost sidebar-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        @endauth

        <a class="btn btn-ghost text-xl pl-1 pr-0" href="/"><i class="fab fa-laravel fa-lg"></i> Kejvin </a>
       @auth
        <span class="text-3xl px-2">/</span>
            <a class="btn-ghost text-neutral-500" href="/profile">{{auth()->user()->username}}</a>
       @endauth
    </div>
    @auth
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar z-10  mx-4 flex">
                <div class="w-10 rounded-full">
                    <img alt="avatar" src="{{auth()->user()->avatar()}}" />
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52 -translate-y-[55px] -translate-x-[70px]">
                <p class="text-xs " role="none">
                    {{ auth()->user()->name}}
                    <br>
                    {{ auth()->user()->email}}
                </p>
                <div class="divider m-0" ></div>
                <li><a href="/profile">Profile</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endauth
    <form class="m-0 size-10 " action="{{route("profile.theme")}}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <label class="size-10 cursor-pointer">
            <i class="fa-solid fa-lightbulb fa-xl"></i>
            <input type="submit" value="">
        </label>
    </form>
</nav>
