<dialog id="{{ 'delete_user_' . $user->id }}" class="modal">
    <div class="modal-box">
        <h3><span class="text-red-500">WARNING! </span>Deleting a user: {{ $user->fullname }}
            ({{ '@' . $user->username }})</h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action flex-container">
            <div class="flex justify-center">
                <form id="delete_form" action="{{route('admin.user.destroy',$user)}}"
                      method="post"
                      class="flex-grow">
                    @method('DELETE')
                    @csrf
                    <input type="submit" name="delete"
                           class=" btn btn-outline btn-warning"
                           id="deleteButton" value="Delete"/>
                </form>
                <div class="divider divider-horizontal">OR</div>

                <form id="delete_form" action="{{route('admin.user.force_destroy',$user)}}"
                      method="post"
                      class="flex-grow">
                    @method('DELETE')
                    @csrf
                    <input type="submit" name="delete"
                           class="btn btn-outline btn-error"
                           id="forceDeleteButton" value="Force Delete"/>
                </form>
            </div>

        </div>
    </div>
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
        </button>
    </form>
</dialog>
