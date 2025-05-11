@extends('layouts.master')

@section('title', 'Customers List')

@section('content')
    <div class="container mt-4">
        <h2>All Customers</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('customers.destroy', $customer->id) }}" id="deleteForm" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" class="btn btn-danger btn-sm " onclick="confirmDelete({{ $customer->id }})">Delete</button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
