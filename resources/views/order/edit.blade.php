@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New</h3>
                    </div>
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label>Customer</label>
                                <select name="customer_id" class="form-control item-product">
                                    <option value="">Choose Product</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {!! $order->customer_id == $customer->id ? 'selected' : '' !!}>
                                            {{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $order->date }}">
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <th width="40%">Product</th>
                                    <th width="15%">Qty</th>
                                    <th width="15%">Price</th>
                                    <th width="15%">Subtotal</th>
                                    <th width="15%">Action</th>
                                </thead>

                                <tbody class="item-container">

                                    @foreach ($order->order_details as $order_detail)
                                        <tr class="item-list">
                                            <td>
                                                <select name="product_id[]" class="form-control item-product">
                                                    <option value="">Choose Product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            data-price="{{ $product->price }}" {!! $order_detail->product_id == $product->id ? 'selected' : '' !!}>
                                                            {{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="qty[]" class="form-control item-qty"
                                                    value="{{ $order_detail->qty }}">
                                            </td>
                                            <td class="price">{{ $order_detail->price }}</td>
                                            <td class="subtotal">{{ $order_detail->subtotal }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary add-item-list">Add</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger hide remove-item-list">Remove</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $("body").delegate('.add-item-list', 'click', function(e) {
                e.preventDefault();
                var c = $(this).parents('.item-list').clone();
                $('.item-container').append(c);
            });

            $("body").delegate('.remove-item-list', 'click', function(e) {
                e.preventDefault();
                if ($('.item-container .item-list').length > 1) {
                    var c = $(this).parents('.item-list');
                    c.remove();
                }
            });

            $("body").delegate('.item-product', 'change', function(e) {
                e.preventDefault();
                var price = $(this).find('option:selected').data('price');
                $(this).parents('.item-list').find('.price').html(price);
            });

            $("body").delegate('.item-qty', 'change', function(e) {
                e.preventDefault();
                let price = $(this).parents('.item-list').find('.price').html();
                let qty = $(this).val();

                let subtotal = price * qty;

                $(this).parents('.item-list').find('.subtotal').html(subtotal);
            });
        });
    </script>
@endpush