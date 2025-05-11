@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Customer</h1>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-6 mb-3">

                    <label for="name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $customer->first_name }}" required>
                </div>
                    <div class="col-md-6 mb-3">

                    <label for="name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $customer->last_name   }}" required>
                </div>

                    <div class="col-md-6 mb-3">

                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ $customer->dob }}" required>
                </div>

                    <div class="col-md-6 mb-3">

                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" class="form-control" value="{{ $customer->age }}">
                </div>

                    <div class="col-md-6 mb-3">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
                </div>
              

            </div>
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </form>
    </div>
@endsection
