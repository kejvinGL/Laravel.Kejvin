
<tr class="border-b border-accent border-spacing-2">
    <!-- USERNAME -->
    <td class="inline-flex w-full bg-base-100 pr-0 md:pr-1">
        <div class="avatar size-6 mr-5">
            <img src="{{ $post->user->getAvatar()}}" alt="{{$post->user->avatar->original_name ?? 'avatar'}}">
        </div>
        <div>
            {{ $post->user->username}}
        </div>
    </td>
    <!-- TITLE -->
    <td class="bg-base-100 pr-0 text-center w-5/12 md:pr-1">

        <div>
            {{ $post->title }}
        </div>
    </td>

    <!-- DATE CREATED -->
    <td class="bg-base-100 text-center">
        {{ $post->created_at->format('H:i @ d/m/y') }}
    </td>

    <!-- COMMENTS -->
    <td class="bg-base-100 hover:bg-base-200  p-0 m-0 text-center table-cell">
        @if($post->comments_count)
            <button class="size-full" onclick="document.getElementById('comments_{{ $post->id }}').showModal()">
                {{ $post->comments_count }}
            </button>
        @else
            0
        @endif
        <x-post-list.modals.view-comments :$post/>
    </td>

    <!-- ACTIONS -->
    <td class="bg-base-100 text-center">
        <button class="btn btn-info btn-xs rounded-md"
                onclick="document.getElementById('view_post_{{ $post->id }}').showModal()">
            <i class="fa-solid fa-eye"></i>{{__('View')}}
        </button>

        <button class="btn btn-error btn-xs rounded-md"
                onclick="document.getElementById('delete_post_{{ $post->id }}').showModal()">
            <i class="fa-solid fa-trash"></i>{{__('Delete')}}
        </button>

        <x-post-list.modals.view-post :$post/>

        <x-post-list.modals.delete-post :$post/>

    </td>
</tr>
