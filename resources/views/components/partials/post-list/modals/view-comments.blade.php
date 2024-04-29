<dialog id="comments_{{ $post->id }}" class="modal ">
    <div class="modal-box p-10 text-start">
        @foreach($post->comments as $comment)
            <div class="divider m-0 p-0"></div>
            <x-partials.home.comment :$comment></x-partials.home.comment>
        @endforeach
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
            </button>
        </form>
    </div>
</dialog>
