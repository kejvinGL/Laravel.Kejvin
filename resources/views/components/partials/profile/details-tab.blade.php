<input type="radio" name="change_tabs" role="tab" class="tab" aria-label="{{__('Details')}}" {{session('tab') == 'details' ? 'checked' : ''}}
/>
<div role="tabpanel" class="profile-tabs">
    <div class="flex-container justify-evenly mx-auto h-3/4 w-[350px]">
        <form class="flex flex-col justify-between pt-8 h-3/4 w-full" name="details_change" id="details_change" action="{{route('profile.details', auth()->user()) }}" method="post">
            @method('PUT')
            @csrf
            <div class="h-1/2 w-full">
                <label class="iconed-input @error('new_username') input-error @enderror">
                    <i class="fa-solid fa-user"></i>
                    <input name="new_username" class="grow" type="text" placeholder="Username" value="{{auth()->user()->username}}" />
                </label>
                <div class="label pt-0">
                    @error('new_username')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="h-1/2 w-full">
                <label class="iconed-input @error('new_email') 'input-error' @enderror">
                    <i class="fa-solid fa-envelope"></i>
                    <input name="new_email" class="grow" type="email" placeholder="Email" value="{{auth()->user()->email}}" />
                </label>
                <div class="label pt-0">

                    @error('new_email')
                    <span class="error-message" role="alert">
                                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
        </form>
    </div>
    <div class="flex flex-col justify-end items-center w-full h-1/4 pb-3">
        <input type="submit" name="submit" value="{{__('Change Details')}}" class="btn flex w-4/5 self-center" id="detailsButton" form="details_change">
    </div>
</div>
