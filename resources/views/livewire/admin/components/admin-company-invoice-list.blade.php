<table class="invoice-list-table table">
    <thead>
    <tr>

        <th>#</th>
        <th>Client</th>
        <th>Total(NAIRA)</th>
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
                <td>{{$invoice->contactInfo->lastname. '  '.$invoice->contactInfo->firstname}}</td>
                <td>{{$invoice->products_total_price + $invoice->services_total_price}}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</td>
                <td>{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</td>
                @if($invoice->signed)
                    <td>Signed</td>
                @else
                    <td>Unsigned</td>
                @endif
                <td><a href="{{route('admin.company-invoice-preview', $invoice->id)}}">Preview</a></td>
                <td><li class="fa fa-trash"></li></td>

            </tr>
        @endforeach
    @endif

    </tbody>
</table>
