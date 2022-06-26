<div>

    <div>
        <section id="ecommerce-searchbar" class="ecommerce-searchbar" style="margin: 10px;">
            <div class="row mt-1">
                <div class="col-sm-12">
                    <p wire:loading.remove wire:target="companySearch">
                        Search for company invoices
                    </p>

                    <p  wire:loading wire:target="companySearch">
                        Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </p>
                    <div class="input-group input-group-merge">
                        <input type="text" wire:model="companySearch" class="form-control search-product" id="shop-search" placeholder="Enter company name" aria-label="Search..." aria-describedby="shop-search" />
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                    </div>
                </div>
            </div>
        </section>


        @if($companySearch)
            <section style="margin: 10px">
                <ul class="list-unstyled categories-list">
                    @if($companies)
                        @foreach($companies as $comp)
                            <li>
                                <div class="form-check">
                                    <input type="radio" id="{{$comp->name}}" name="company-filter" class="form-check-input" value="{{$comp->id}}" wire:model="company" />
                                    <label class="form-check-label" for="{{$comp->name}}">{{$comp->name}}</label>
                                </div>
                            </li>
                        @endforeach
                    @endif

                </ul>
                <div id="clear-filters">
                    <button type="button" wire:click="clearFilter" class="btn btn-primary">Clear all filters</button>
                </div>
            </section>
            @if($company)
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
                                <td>{{$invoice->contactInfo->user->lastname. '  '.$invoice->contactInfo->user->firstname}}</td>
                                <td>{{$settings->app_currency_symbol}}{{$invoice->products_total_price + $invoice->services_total_price}}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</td>
                                <td>{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</td>
                                @if($invoice->signed)
                                    <td>Signed</td>
                                @else
                                    <td>Unsigned</td>
                                @endif
                                <td><a href="{{route('admin.invoice-preview', $invoice->id)}}">Preview</a></td>

                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            @endif
        @else
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
                        <td>{{$invoice->contactInfo->user->lastname. '  '.$invoice->contactInfo->user->firstname}}</td>
                        <td>{{$settings->app_currency_symbol}}{{$invoice->products_total_price + $invoice->services_total_price}}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->date_issued)->translatedFormat(' j F Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($invoice->due_date)->translatedFormat(' j F Y')}}</td>
                        <td>{{$invoice->worker->user->lastname. '  ' .$invoice->worker->user->firstname }}</td>
                        @if($invoice->signed)
                            <td>Signed</td>
                        @else
                            <td>Unsigned</td>
                        @endif
                        <td><a href="{{route('admin.invoice-preview', $invoice->id)}}">Preview</a></td>

                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
        @endif

        {{ $invoices->links('components.general.pagination-links') /* For pagination links */}}
    </div>

</div>




