<dialog id="view_post_{{ $post->id }}" class="modal ">
    <div class="modal-box p-10 text-start">
        <p>{{ $post->title }}</p>
        <div class="divider"></div>
        <p class="text-sm text-gray-400">{{ $post->body }}</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                </button>
            </form>
        </div>
    </div>
</dialog>
