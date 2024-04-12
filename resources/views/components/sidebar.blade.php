<div class="fixed left-0 top-0 w-64 h-full bg-base-100 p-4 mt-16 z-50 sidebar-menu transition-transform -translate-x-full">
    <ul class="mt-4">
        @if(auth()->user()->getRole() === 1)
            <x-partials.sidebar.admin>
            </x-partials.sidebar.admin>
        @else
            <x-partials.sidebar.client>
            </x-partials.sidebar.client>
        @endif
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay hidden"></div>
