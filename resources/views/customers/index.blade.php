@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customers</h1>

    <form method="GET" action="{{ route('customers.index') }}">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="email" class="form-control" placeholder="Customer Email" value="{{ request('email') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="order_number" class="form-control" placeholder="Order Number" value="{{ request('order_number') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="item_name" class="form-control" placeholder="Item Name" value="{{ request('item_name') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Orders</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>
                    @foreach ($customer->orders as $order)
                    <p>Order #{{ $order->order_number }}</p>
                    @endforeach
                </td>
                <td>
                    @foreach ($customer->orders as $order)
                    @foreach ($order->items as $item)
                    <p>{{ $item->name }} ({{ $item->quantity }})</p>
                    @endforeach
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        @if ($customers->previousPageUrl())
            <a href="{{ $customers->previousPageUrl() }}&{{ http_build_query($filters) }}" class="btn btn-primary">&laquo; Previous</a>
        @else
            <span></span>
        @endif

        @if ($customers->nextPageUrl())
            <a href="{{ $customers->nextPageUrl() }}&{{ http_build_query($filters) }}" class="btn btn-primary">Next &raquo;</a>
        @endif
    </div>
</div>
@endsection
