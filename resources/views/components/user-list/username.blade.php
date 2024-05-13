<div class="inline-flex">
    <div class="avatar mask mask-circle size-6 mr-5">
        <img src="{{ $user->getAvatar()}}" alt="{{$user->avatar->original_name ?? 'avatar'}}">
    </div>
    <div>
        {{ $user->username}}
    </div>
</div>
