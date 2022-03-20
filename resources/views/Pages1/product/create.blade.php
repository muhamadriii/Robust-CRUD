@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New</h3>
                </div>
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>Category :</label>
                            <select class="form-control" name="category_id" id="" class="from-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Brand :</label>
                            <select class="form-control" name="brand_id" id="">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit :</label>
                            <select class="form-control" name="unit_id" id="">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label>Price :</label>
                            <select class="from-control" name="price" id="">
                                @foreach($prices as $price)
                                    <option value="{{ $price->id }}">
                                        {{ $price->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Stock :</label>
                            <select class="from-control" name="stock" id="">
                                @foreach($stocks as $stock)
                                    <option value="{{ $stock->id }}">
                                        {{ $stock->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image :</label>
                            <select class="from-control" name="image" id="">
                                @foreach($images as $image)
                                    <option value="{{ $image->id }}">
                                        {{ $image->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label>Price :</label>
                            <input type="text" name="price" class="form-control" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label>Stock :</label>
                            <input type="text" name="stock" class="form-control" placeholder="Stock">
                        </div>
                        <div class="form-group">
                            <label>image :</label>
                            <input type="text" name="image" class="form-control" placeholder="Image">
                        </div>
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