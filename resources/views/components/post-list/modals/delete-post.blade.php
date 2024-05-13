<dialog id="delete_post_{{ $post->id }}" class="modal">
    <div class="modal-box">
        <h3>Are you sure you want to delete this Post?</h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action">
            <form method="post" action="{{ route('post.destroy', $post) }} "
                  class="w-full">
                @method('DELETE')
                @csrf
                <div class="flex justify-center">
                    <input type="submit" name="delete"
                           class="btn btn-error btn-outline btn-md text-xs" value="Delete"/>
                </div>
            </form>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                </button>
            </form>
        </div>
    </div>

</dialog>
