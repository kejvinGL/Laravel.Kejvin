<dialog id="{{ 'delete_key_' . $key->id }}" class="modal">
    <div class="modal-box">
        <h3><span class="text-red-500">WARNING! </span>Deleting an API Key: {{ $key->name }} </h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action flex-container">
            <div class="flex justify-center">
                <form id="delete_form" action="{{route('admin.api_key.destroy',$key)}}"
                      method="post"
                      class="flex-grow">
                    @method('DELETE')
                    @csrf
                    <input type="submit" name="delete"
                           class=" btn btn-outline btn-error"
                           id="deleteButton" value="Delete"/>
                </form>
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕
                    </button>
                </form>
            </div>

        </div>
    </div>
</dialog>
