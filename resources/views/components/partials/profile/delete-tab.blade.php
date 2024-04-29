<div class="flex-container">
    <button class="btn btn-error w-[150px] mb-5" onclick="my_modal_1.showModal()">{{__('DELETE USER')}}</button>
    @error('delete_password')
    <span class="error-message text-nowrap" role="alert">
                        {{ $message }}
        </span>
    @enderror
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box flex-container">
            <h3 class="font-bold text-lg">Warning!</h3>
            <span class="text-xs text-gray-400">{{__('By Deleting this account you can not recover your lost data!')}}</span> <br>
            <span class="text-xs text-gray-400">{{__('Are you sure you want to continue?')}}</span>
            <form id="delete_form" class="flex-container justify-center pt-4"
                  action="{{route('profile.destroy', auth()->user())}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" name="submit" form="delete_form" class="btn btn-outline btn-error"
                       id="deleteButton" value="{{__('Delete')}}"/>
            </form>
            <form method="dialog">
                <button class="btn btn-circle btn-ghost text-lg absolute right-2 top-2">✕
                </button>
            </form>
        </div>
    </dialog>
</div>
