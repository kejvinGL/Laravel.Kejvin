<div class="h-20 w-full">
    <div class="flex justify-between w-full ">
        <div>
            <img src="{{$comment->user->getAvatar()}}" class="size-8 inline" alt="{{$user->avatar->original_name ?? 'avatar'}}">
            <span>{{$comment->user->name}}</span>
        </div>
        @can('delete', $comment)
            <form class="inline" method="POST" action="{{route('comment.destroy', $comment)}}">
                @csrf
                @method("DELETE")
                <button class="btn btn-error btn-xs size-5" type="submit">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        @endcan
    </div>
    <span class="text-xs">{{$comment['body']}}</span>

</div>
