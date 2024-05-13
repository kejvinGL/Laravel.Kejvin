<div class="collapse">
    <input name="show" type="checkbox"/>
    <div class="collapse-title">
        <i class="fa-solid fa-comment"></i> Comments ({{$post->comments_count ?? 0}})
    </div>
    <div class="collapse-content">
        <form class="mt-5" method="POST" action="{{route('comment.store',$post)}}">
            @csrf
            <textarea name="body" class="textarea textarea-bordered w-full h-12 text-xs" placeholder="..."></textarea>
            <input name="submit" value="Add Comment" type="submit" class="btn btn-xs btn-secondary">
        </form>
        @foreach($post->comments as $comment)
            <div class="divider m-0 p-0"></div>
            <x-partials.home.comment :$comment></x-partials.home.comment>
        @endforeach
    </div>
</div>
