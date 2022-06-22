@component('mail::message')
# Hi, {{ $data['name']  }}
<p style="text-align: center">{{$data['subject']}}</p>
<p>FROM: {{$data['user']->lastname. ' ' .$data['user']->firstname}}</p>
<p>{{$data['message']}}</p>


@component('mail::button', ['url' => route('company.preview-invoice', $data['invoice']->id)])
   View invoice
@endcomponent

Thanks,<br>
{{ $settings->app_name }}
@endcomponent
