<table class="invoice-list-table table">
    <thead>
    <tr>

        <th>#</th>
        <th>Contact</th>
        <th>Total({{$settings->app_currency}})</th>
        <th class="text-truncate">Issued Date</th>
        <th class="text-truncate">Due Date</th>
        <th>Assigned to</th>
        <th>Invoice Status</th>
        <th class="cell-fit">Actions</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @if($invoices)
        @foreach($invoices as $invoice)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>
                    @if($invoice->ContactInfo)
                    {{$invoice->contactInfo->lastname. '  '.$invoice->contactInfo->firstname}}
                    @else
                    <span class="text-danger">Contact deleted</span>
                    @endif
                </td>
                <td>{{$settings->app_currency_symbol}}{{$invoice->products_total_price + $invoice->services_total_price}}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</td>
                <td>{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</td>
                @if($invoice->signed)
                    <td class="text-success">Signed</td>
                @else
                    <td class="text-danger">Unsigned</td>
                @endif
                <td><a href="{{route('company.preview-invoice', $invoice->id)}}">Preview</a>
                @if(Auth::user()->hasModuleAccess('invoice', 'delete'))
                <td style="cursor:pointer;" wire:click="remove({{$invoice->id}})">
                    <li wire:target="remove({{$invoice->id}})" wire:loading.remove class="fa fa-trash"></li>
                    <li wire:target="remove({{$invoice->id}})" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></li>
                </td>
                @endif

            </tr>
        @endforeach
    @endif

    </tbody>
</table>
