<div class="flex flex-col items-center">
    <button class="btn btn-error w-[150px] mb-5" onclick="my_modal_1.showModal()">DELETE USER</button>
    @error('delete_password')
    <span class="label-text-alt text-red-500 text-nowrap" role="alert">
                        {{ $message }}
        </span>
    @enderror
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Warning!</h3>
            <p class="py-4"><span class="text-xs text-gray-400">By Deleting User you can not recover lost
                    data!<br><br></span> <span class="text-sm"> Enter your password to continue:</span></p>
            <div class="modal-action flex flex-col">
                <form id="delete_form" class="inline-flex join" action="{{route('profile.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="password" name="delete_password" class="input input-bordered join-item w-full max-w-xs" id="enter_pass" placeholder="********" />
                    <input type="submit" name="submit" form="delete_form" class="btn btn-outline join-item btn-error" id="deleteButton" value="Delete" />
                </form>
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</div>
