@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Create New Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="row">

                <div class="col-md-6 mb-3">

                    <label for="name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" value="{{ old('first_name') }}" name="first_name" required>
                </div>
                    <div class="col-md-6 mb-3">

                    <label for="name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" value="{{ old('last_name') }}" name="last_name" required>
                </div>

                    <div class="col-md-6 mb-3">

                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required>
                </div>

                    <div class="col-md-6 mb-3">

                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="{{ old('age') }}" class="form-control" >
                </div>

                <div class="col-md-6 mb-3">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                

            </div>
            <button type="submit" class="btn btn-primary">Create Customer</button>
        </form>
    </div>
@endsection
