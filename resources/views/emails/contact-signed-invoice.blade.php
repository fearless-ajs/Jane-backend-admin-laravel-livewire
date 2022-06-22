@component('mail::message')
<h3 style="text-align: center">{{$data['subject']}}</h3>
#Hi, {{ $data['name']  }}
<p>{{$data['invoice']->contactInfo->title}} {{$data['invoice']->contactInfo->lastname. ' ' . $data['invoice']->contactInfo->firstname}} signed your invoice,
please login your dashboard to view the signed copy
</p>


@component('mail::button', ['url' => route('company.preview-invoice', $data['invoice']->id)])
   View invoice
@endcomponent

Thanks,<br>
{{ $settings->app_name }}
@endcomponent
