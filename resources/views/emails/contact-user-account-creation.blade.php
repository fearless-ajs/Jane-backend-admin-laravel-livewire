@component('mail::message')
# Hi, {{ $user->firstname  }}
<p>CRM account was successfully created for you! 🎉🙏</p>
<p>{{$company->name}} company added you to their contacts list and an account has been generated for you on our store.</p>
<p>Please login with your email and "{{$user->lastname}}" as your password</p>


@component('mail::button', ['url' => route('login')])
   Visit store
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
