<dialog id="{{"edit_user_" . $user->id }}" class="modal">
    <div class="modal-box">
        <h3><span class="text-red-500">WARNING! </span>Editing User Information</h3>
        <p class="text-xs text-gray-600">Press ESC to cancel</p>
        <div class="modal-action">
            <form method="POST" action="{{route('admin.user.edit', $user->id)}}" id="edit_user"
                  class="w-full">
                @method('put')
                @csrf
                <label class="iconed-input">
                    <i class="fa-solid fa-user"></i>
                    <input name="new_username" class="grow " type="text" placeholder="Username"
                           value={{$user->username}} minlength="5" required/>
                </label>
                <label class="iconed-input w-full">
                    <i class="fa-solid fa-envelope"></i>
                    <input name="new_email" class="grow" type="email" placeholder="Email"
                           value="{{$user->email}}" required/>
                </label>
                <div class="flex justify-center">
                    <input type="submit" name="edit"
                           class="btn btn-error btn-outline btn-md text-xs"
                           value="Save Changes"/>
                </div>
            </form>
            <form method="dialog">
                <button class="btn btn-circle btn-ghost text-lg absolute right-2 top-2">✕
                </button>
            </form>
        </div>
    </div>
</dialog>
