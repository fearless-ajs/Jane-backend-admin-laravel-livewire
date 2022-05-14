@component('mail::message')
# Hi, {{ $user->firstname  }}
<p>Your CRM account email was recently changed! 🎉🙏</p>
<p>Kindly verify your email address to ensure we have the working
    email, we need this to keep your account active.</p>


@component('mail::button', ['url' => getenv('APP_URL').'/verify-changed-email/'.$token])
    Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
