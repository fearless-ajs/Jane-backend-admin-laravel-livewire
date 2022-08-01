<div>
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="contact" class="card-title">
            {{count($subs)}}
            @if(count($subs) > 1)
                subscriptions
            @else
                subscription
            @endif
        </h4>
        <h4 wire:loading wire:target="contact" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>


{{--        <select wire:model="contact" class="invoiceto form-select {{$errors->has('contact')? 'is-invalid' : '' }}">--}}
{{--            <option value="">-- Select company--</option>--}}
{{--            @if($contactRecords)--}}
{{--                @foreach($contactRecords as $contact)--}}
{{--                    <option value="{{$contact->id}}">{{$contact->company->name }}</option>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </select>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-4 user_role"></div>--}}
{{--            <div class="col-md-4 user_plan"></div>--}}
{{--            <div class="col-md-4 user_status"></div>--}}
{{--        </div>--}}
    </div>


    <table class="invoice-list-table table">
        <thead>
        <tr>

            <th>#</th>
            <th>Name</th>
            <th>Price({{$settings->currency->currency_name}})</th>
            <th>Status</th>
            <th>Billing</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @if($subs)
            @foreach($subs as $sub)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>
                        @if($sub->catalogue)
                            {{$sub->catalogue->name}}
                        @else
                            <span class="text-danger">Subscription deleted</span>
                        @endif
                    </td>

                    <td>
                        @if($sub->catalogue)
                            {{$settings->app_currency_symbol}}
                            @if($sub->catalogue->tax)
                                {{ (($sub->catalogue->tax->percentage / 100 ) * $sub->catalogue->price) + $sub->catalogue->price }}
                            @else
                                {{$sub->catalogue->price}}
                            @endif
                        @else
                            <span class="text-danger">Subscription deleted</span>
                        @endif
                    </td>
                    <td>
                        @if($sub->active)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td>
                        @if($sub->catalogue && $sub->catalogue->cycle)
                            {{$sub->catalogue->cycle->title}}
                        @else
                            Not available
                        @endif
                    </td>
{{--                    <td>{{ \Carbon\Carbon::parse($sub->due_date)->translatedFormat(' j F Y')}}</td>--}}

                    <td><a href="{{route('contact.subscription-details', $sub->id)}}">Track</a>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    {{ $subs->links('components.general.pagination-links') /* For pagination links */}}

</div>
