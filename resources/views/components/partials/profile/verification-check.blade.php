@if(auth()->user()->email_verified_at)
    <span class="text-green-500 bold"> <i class="fa fa-solid fa-user-check fa-xl"></i> {{__('Verified')}}</span>
@else
    @if (session('resent'))
        <div class="text-green-200">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <p class="inline">Welcome, {{ auth()->user()->name }}! Please </p>
    <form class="inline" action="{{route('verification.resend', auth()->user())}}" method="POST">
        @csrf
        <input type="submit" name="submit" value="verify your account" class="btn btn-link text-lg m-0 p-0">
    </form>.

@endif
