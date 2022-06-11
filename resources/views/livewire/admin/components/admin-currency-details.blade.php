<div class="card">

    <div class="card-datatable table-responsive pt-0" >
        <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#editCurrencyModal">
            Edit currency
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
                    <tr>
                        <td>{{$currency->country }}</td>
                        <td>{{$currency->currency_name }}</td>
                        <td>{{$currency->currency_symbol}}</td>
                        <td>{{$currency->rate_to_dollar}}</td>

                        <td>{{$currency->created_at->diffForHumans()}}</td>

                    </tr>
            </tbody>
        </table>
    </div>


</div>



