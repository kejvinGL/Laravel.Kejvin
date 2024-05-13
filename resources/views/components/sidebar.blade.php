<div class="fixed z-20 left-0 top-0 w-64 h-full bg-base-100 p-4 pt-16 sidebar-menu transition-transform ">
    <ul class="mt-4">
        @if(auth()->user()->role->id === 1)
            <x-partials.sidebar.admin>
            </x-partials.sidebar.admin>
        @else
            <x-partials.sidebar.client>
            </x-partials.sidebar.client>
        @endif
    </ul>
</div>
<div class="fixed z-10 top-0 left-0 w-full h-full sidebar-overlay"></div>
