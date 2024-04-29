<input type="radio" name="change_tabs" role="tab" class="tab" aria-label="{{__('Avatar')}}" {{ session('tab') == 'avatar' ? 'checked' : '' }} />
<div role="tabpanel" class="profile-tabs">
    <div class="flex-container justify-evenly mx-auto h-3/4 w-[300px]">
        <form class="flex flex-col justify-between h-3/4" name="avatar-change" id="avatar-change" action="{{route('profile.avatar')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="flex-container justify-evenly">
                <div class="size-36 mask mask-circle mb-8">
                    <img src="{{ auth()->user()->getAvatar() }}" class="size-full" alt="avatar" />
                </div>
                <label class="form-control w-full self-end">
                    <input name="avatar" type="file" accept="image/png, image/gif, image/jpeg" class="file-input file-input-bordered @error('avatar') file-input-error @enderror " onchange="enableChange(this)" />
                </label>
            </div>
        </form>
    </div>
    <div class="flex-container justify-end  w-full h-1/4 pb-3">
        @error('avatar')
        <span class="error-message text-nowrap" role="alert">
                        {{ $message }}
        </span>
        @enderror
        <input type="submit" name="submit" class="btn flex w-4/5 self-center" id="avatarButton" form="avatar-change" value="Change Avatar" disabled>
    </div>
</div>

<script>
    function enableChange(fileInput) {
        let changeButton = document.getElementById("avatarButton");
        if (fileInput.value) {
            changeButton.disabled = false;
        } else {
            changeButton.disabled = true;
        }
    }
</script>
