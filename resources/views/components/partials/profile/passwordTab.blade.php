<input type="radio" name="change_tabs" role="tab" class="tab" aria-label="Password" {{ session('tab') == 'password' ? 'checked' : '' }} />
<div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box w-[450px] h-[350px]">
    <div class="flex flex-col items-center justify-evenly mx-auto h-4/5 w-[350px]">
        <form class="flex flex-col justify-between pt-8 h-[250px] items-center w-full" name="password_change" id="password_change" action="{{route('profile.password')}}" method="post">
            @method('PUT')
            @csrf
            <div class="h-1/3 w-full">
                <input name="current_password" type="password" class="input input-bordered w-full @error('current_password') input-error @enderror" placeholder="Current Password" />
                <div class="label pt-0">
                    @error('current_password')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="h-1/3 w-full">
                <input name="new_password" type="password" class="input input-bordered w-full @error('new_password') input-error @enderror" placeholder="New Password" />
                <div class="label pt-0">
                    @error('new_password')
                    <span class="label-text-alt text-red-500 text-nowrap" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="h-1/3 w-full">
                <input name="new_password_confirmation" type="password" class="input input-bordered w-full @error('repeat_password') input-error @enderror" placeholder="Repeat New Password" />
                <div class="label pt-0">
                    @error('repeat_password')
                    <span class="label-text-alt text-red-500" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </form>
    </div>
    <div class="flex flex-col justify-end items-center w-full h-1/5 pb-3">
        <input type="submit" name="submit" class="btn flex w-4/5 self-center" form="password_change" value="Change Password">
    </div>
</div>
