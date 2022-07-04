@component('mail::message')
# Hi, {{ $user->firstname  }}
<p>Your two factor code is {{$user->two_factor_code}}</p>


@component('mail::button', ['url' => route('verify-two-factor-through-link', $user->two_factor_code)])
    Verify Here
@endcomponent

<p>The code will expire in 10 minutes, if you have not tried login, ignore this message</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
