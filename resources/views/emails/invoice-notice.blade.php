@component('mail::message')
# Hi,
<p>{{$data['message']}}</p>


@component('mail::button', ['url' => getenv('APP_PUBLIC_URL').'/contact/invoice/'.$invoice->id])
    View invoice
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
