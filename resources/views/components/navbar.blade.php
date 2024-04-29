<nav class="fixed z-20 navbar bg-base-100 top-0">
    <div class="flex-1">
        @auth
            <button type="button" class="text-lg text-neutral-400 size-10 btn btn-ghost sidebar-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>
        @endauth

        <a class="btn btn-ghost text-xl pl-1 pr-1" href="/"><i class="fab fa-laravel fa-lg"></i> Kejvin </a>
       @auth
        <span class="text-3xl px-2">/</span>
            <a class="btn-ghost text-neutral-500" href="/profile">{{auth()->user()->username}}</a>
       @endauth
    </div>
    <form method="post" action="">

    </form>

    @auth
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar z-10  mx-4 flex">
                <div class="w-10 rounded-full">
                    <img alt="avatar" src="{{auth()->user()->getAvatar()}}" />
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52 -translate-y-[55px] -translate-x-[70px]">
                <p class="text-xs " role="none">
                    {{ auth()->user()->name}}
                    <br>
                    {{ auth()->user()->email}}
                </p>
                <div class="divider m-0" ></div>
                <li><a href="/profile">{{__('Profile')}}</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endauth
    <form class="size-8" action="{{route("theme")}}" method="POST">
        @method('PUT')
        @csrf
        <label class="cursor-pointer">
            <i class="fa-solid fa-lightbulb fa-xl"></i>
            <input type="submit" hidden>
        </label>
    </form>

    <form action="{{route("lang")}}" method="POST">
        @method('PUT')
        @csrf
        <select name="lang" class="select select-ghost outline-0 text-xl text-accent pr-8" onchange="document.getElementById('submitButton').click();">
            @foreach(['en', 'al'] as $lang)
                <option value="{{ $lang }}" @if(app()->currentLocale() == $lang) selected @endif>{{ strtoupper($lang) }}</option>
            @endforeach
        </select>
        <input type="submit" id="submitButton" hidden>
    </form>
</nav>
