@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data</h3>

                        <div class="card-tools">
                            <a href="{{ route('order.create') }}" class="btn btn-primary btn-sm">Create</a>
                            {{-- <a href="{{ route('order.export') }}" class="btn btn-primary btn-sm">Export</a> --}}
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datum)
                                    <tr>
                                        <td>{{ $datum->id }}</td>
                                        <td>{{ $datum->code }}</td>
                                        <td>{{ data_get($datum, 'customer.name') }}</td>
                                        <td>{{ $datum->date }}</td>
                                        <td>{{ number_format($datum->total) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Action</button>
                                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('order.show', $datum->id) }}">Detail</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('order.edit', $datum->id) }}">Edit</a>

                                                    <form action="{{ route('order.destroy', $datum->id) }}"
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