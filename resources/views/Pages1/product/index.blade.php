@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Product</h3>

                    <div class="card-tools">
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Create</a>
                        <a href="{{ route('product.export') }}" class="btn btn-primary btn-sm">Export</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>stock</th>
                                <th>image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n=1;
                            @endphp
                            @foreach ($data as $datum)
                                <tr>
                                    <td>{{ $n++}}</td>
                                    <td>{{ $datum->name }}</td>
                                    <td>{{ $datum->category->name }}</td>
                                    <td>{{ $datum->brand->name }}</td>
                                    <td>{{ $datum->unit->id }}</td>
                                    <th>Rp.{{ $datum ? number_format($datum->price) : '-'}}</th>
                                    <th>{{ $datum->stock->id }}</th>
                                    <th>{{ $datum->image }}</th>
                                    <td>{{ $datum->action }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a class="dropdown-item"
                                                    href="{{ route('product.show', $datum->id) }}">Detail</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('product.edit', $datum->id) }}">Edit</a>

                                                <form action="{{ route('product.destroy', $datum->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
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