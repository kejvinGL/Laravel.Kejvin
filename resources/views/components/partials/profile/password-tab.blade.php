<input type="radio" name="change_tabs" role="tab" class="tab"
       aria-label={{__("Password")}} {{ session('tab') == 'password' ? 'checked' : '' }} />
<div role="tabpanel" class="profile-tabs">
    <div class="flex-container justify-evenly mx-auto h-4/5 w-[350px]">
        <form class="flex flex-col justify-between pt-8 h-[250px] items-center w-full" name="password_change"
              id="password_change" action="{{ route('profile.password', auth()->user()) }}" method="post">
            @method('PUT')
            @csrf
            <div class="h-1/3 w-full">
                <input name="current_password" type="password"
                       class="input input-bordered w-full @error('current_password') input-error @enderror"
                       placeholder="{{__('Current Password')}}"/>
                <div class="label pt-0">
                    @error('current_password')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="h-1/3 w-full">
                <input name="new_password" type="password"
                       class="input input-bordered w-full @error('new_password') input-error @enderror"
                       placeholder="{{__('New Password')}}"/>
                <div class="label pt-0">
                    @error('new_password')
                    <span class="error-message text-nowrap" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="h-1/3 w-full">
                <input name="new_password_confirmation" type="password"
                       class="input input-bordered w-full @error('repeat_password') input-error @enderror"
                       placeholder="{{__('Repeat New Password')}}"/>
                <div class="label pt-0">
                    @error('repeat_password')
                    <span class="error-message" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </form>
    </div>
            <div class="flex-container justify-end items-center w-full h-1/5 pb-3">
                <input type="submit" name="submit" class="btn flex w-4/5 self-center" form="password_change"
                       value="{{__('Change Password')}}">
            </div>

</div>
