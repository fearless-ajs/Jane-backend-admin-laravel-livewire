@component('mail::message')
# Hi, {{ $user->firstname  }}
<p>Your employee account was successfully created under {{$company->name}} company! 🎉🙏</p>
<p>Kindly login to your account to gain access to your workspace</p>


@component('mail::button', ['url' => route('sign-in')])
    Sign in
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
