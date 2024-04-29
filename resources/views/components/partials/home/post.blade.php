<div
    class="flex-container min-h-[200px] w-full min-w-[400px] bg-base-200 border border-secondary rounded-2xl p-2">
    <div class="flex w-full">
        <div class="flex flex-col w-full h-1/6 items-center min-h-[45px]">
            <div class="flex rounded-xl w-full items-center">
                <img src="{{$post->user->getAvatar()}}" class="size-8" alt="avatar"/>
                <span class="m-3">
                {{$post->user->name}}
            </span>
            </div>

            <div class="flex w-full justify-between align-bottom pl-3">
                <span class="inline text-sm font-bold">
                    {{$post->title}}
                </span>
                <span class="inline pl-2 text-xs text-neutral-500 text-nowrap text-right h-min">
                    {{ $post->created_at->format('H:i') }}
                    <br>
                    {{ $post->created_at->format('d/M/y') }}
                </span>
            </div>


        </div>

        <div class="flex delete w-1/12 justify-end pr-2">
        @can('delete', $post)
            <button class="btn btn-error btn-xs rounded-md" onclick="post_{{ $post->id }}.showModal()">
                <i class="fa-solid fa-trash"></i>
            </button>
            <dialog id="post_{{ $post->id }}" class="modal">
                <div class="modal-box">
                    <h3>Are you sure you want to delete this Post?</h3>
                    <p class="text-xs text-gray-600">Press ESC to cancel</p>
                    <div class="modal-action">
                        <form method="post" action="{{route('post.destroy', $post )}}" class="w-full">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="flex justify-center">
                                <input type="submit" name="delete" class="btn btn-error btn-outline btn-md text-xs"
                                       value="Delete"/>
                            </div>
                        </form>
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                    </div>
                </div>
            </dialog>
            @endcan
        </div>
    </div>
    <div class="divider m-0"></div>
    <div class="w-full pl-3 text-sm overflow-auto">
        {{$post->body}}
    </div>
    <div class="w-full p-3 text-sm overflow-auto">
        @if($post?->media)
            <img src="{{$post->getMedia()}}" class="w-full">
        @endif
    </div>
    <x-partials.home.comment-section :$post>
    </x-partials.home.comment-section>
</div>
