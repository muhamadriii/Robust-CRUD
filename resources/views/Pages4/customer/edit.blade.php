@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New</h3>
                    </div>
                    <form action="{{ route('customer.update', $data->id ) }}" method="POST">
                        @csrf
                        @method('PUT');

                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $data->email }}">
                            </div>
                            <div class="form-group">
                                <label>Phone :</label>
                                <input type="number" name="phone" class="form-control" placeholder="Phone" value="{{ $data->phone }}">
                            </div>
                            <div class="form-group">
                                <label>Address :</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $data->address }}">
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