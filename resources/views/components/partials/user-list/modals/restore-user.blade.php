<dialog id="{{ 'restore_user_' . $user->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-sm"> Are you sure you want to restore this user? {{ $user->fullname }}
            ({{ '@' . $user->username }})</h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action flex-container">
            <form method="POST"
                  action="{{route('admin.user.restore', $user)}}"
                  class="flex justify-center"
            >
                @method('PUT')
                @csrf
                <input type="submit" name="restore"
                       class="btn btn-outline join-item btn-success"
                       id="restoreButton"
                       value="Restore"
                />
            </form>
            <form method="dialog">
                <button class="btn btn-circle btn-ghost text-lg absolute right-2 top-2">✕
                </button>
            </form>
        </div>
    </div>
</dialog>
