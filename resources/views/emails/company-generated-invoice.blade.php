@component('mail::message')
<h3 style="text-align: center">{{$data['subject']}}</h3>
#Hi, {{ $data['name']  }}
<p>{{$data['invoice']->company->name}} generated an invoice for you, please login to your dashboard to view details
</p>


@component('mail::button', ['url' => route('contact.invoices-preview', $data['invoice']->id)])
   View invoice
@endcomponent

Thanks,<br>
{{ $settings->app_name }}
@endcomponent
