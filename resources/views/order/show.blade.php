@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $data->id }}</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td>{{ $data->code }}</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td>{{ data_get($data, 'customer.name') }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>{{ $data->date }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ number_format($data->total) }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $data->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Detail</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->order_details as $order_detail)
                                    <tr>
                                        <td>{{ data_get($order_detail, 'product.name') }}</td>
                                        <td>{{ number_format($order_detail->price) }}</td>
                                        <td>{{ $order_detail->qty }}</td>
                                        <td>{{ $order_detail->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection