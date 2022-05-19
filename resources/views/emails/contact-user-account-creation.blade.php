@component('mail::message')
# Hi, {{ $user->firstname  }}
<p>Your CRM account was successfully created! 🎉🙏</p>
<p>{{$company->name}} company added you to their contacts list and an account has been generated for you on our store.</p>
<p>Please login with your email and "crmcode" as your password</p>


@component('mail::button', ['url' => route('login')])
   Visit store
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
