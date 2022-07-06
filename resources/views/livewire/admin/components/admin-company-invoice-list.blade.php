<div>
    <table class="invoice-list-table table">
        <thead>
        <tr>

            <th>#</th>
            <th>Client</th>
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
                            {{$invoice->contactInfo->firstname. '  '.$invoice->contactInfo->lastname}}
                        @else
                            <span class="text-danger">Contact deleted</span>
                        @endif
                    </td>

                    <td>{{$settings->currency->currency_symbol}}{{$invoice->products_total_price + $invoice->services_total_price}}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</td>
                    @if($invoice->worker)
                        <td>{{$invoice->worker->firstname. '  ' .$invoice->worker->lastname }}</td>
                    @else
                        <span class="text-danger">Staff not available</span>
                    @endif
                    @if($invoice->signed)
                        <td>Signed</td>
                    @else
                        <td>Unsigned</td>
                    @endif
                    <td><a href="{{route('admin.company-invoice-preview', $invoice->id)}}">Preview</a></td>

                    <td style="cursor:pointer;" wire:click="remove({{$invoice->id}})">
                        <li wire:target="remove({{$invoice->id}})" wire:loading.remove class="fa fa-trash"></li>
                        <li wire:target="remove({{$invoice->id}})" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></li>
                    </td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
        {{ $invoices->links('components.general.pagination-links') /* For pagination links */}}
</div>




