<div class="card">
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($currencies)}} @endif Currencies</h4>
        <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

        <input type="text" class="form-control" wire:model="search" placeholder="Search for currency by country"/>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>

    <div class="card-datatable table-responsive pt-0" >
            <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addCurrencyModal">
                Add currency
            </button>
        <table class="user-list-table table">
            <thead class="table-light">
            <tr>
                <th>Country</th>
                <th>Name</th>
                <th>Symbol</th>
                <th>Rate to Dollar</th>
                <th>Created</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($currencies)
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{$currency->country }}</td>
                        <td>{{$currency->currency_name }}</td>
                        <td>{{$currency->currency_symbol}}</td>
                        <td>{{$currency->rate_to_dollar}}</td>

                        <td>{{$currency->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('admin.currency-details', $currency->id)}}">Details</a> </td>
                        <td wire:loading wire:target="remove({{$currency->id}})" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                        <td wire:loading.remove wire:target="remove({{$currency->id}})" >
                            <i class="fa fa-trash" wire:click="remove({{$currency->id}})" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        @if(!$searchResult)
            {{ $currencies->links('components.general.pagination-links') /* For pagination links */}}
        @endif
    </div>


</div>



