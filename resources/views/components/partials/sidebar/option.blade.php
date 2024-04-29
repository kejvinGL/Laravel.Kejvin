<li class="mb-1 group">
    <a href="{{ $data['url']}}" class="flex font-semibold items-center py-2 px-4 text-neutral-500 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
        <span class="w-1/6">
            <i class="{{$data['icon']}} mr-2"></i>
        </span>
        <span class="text-sm">
            {{$data['title']}}
        </span>
    </a>
</li>
