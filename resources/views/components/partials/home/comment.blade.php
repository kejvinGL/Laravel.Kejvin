<div class="h-20 w-full mb-12 last:mb-4">
    <img src="{{$comment['avatar']}}" class="size-8 inline" alt="commenter">
    <span class="text-accent">{{$comment["poster"]}}</span>
    @if($comment['user_id'] === auth()->id())
        <form class="inline" method="POST" action="{{route('comment.destroy',$comment['id'])}}">
            @csrf
            @method("DELETE")
            <button class="btn btn-error btn-xs size-5" type="submit">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
    @endif
    <br>
    <span class="text-xs">{{$comment['body']}}</span>
</div>
