<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = Customer::all(); // Get all customers
        return view('customers.index', compact('customers'));
    }

    // Show the form for creating a new customer
    public function create()
    {
        return view('customers.create');
    }

    // Store a newly created customer in the database
    public function store(Request $request)
    {
        try{
                DB::beginTransaction(); 

                $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:customers,email', // Ensure email is unique in the customers table
                'first_name' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput(); // Redirect back with errors and input
                } 
                $data = $request->except('_token');

                Customer::create($data);
                DB::commit();

                return redirect()->route('customers.index')->with('success', 'Customer created successfully.');

        }catch (\Illuminate\Database\QueryException $exception) {
			DB::rollBack();
			return back()->with('error', $exception->getMessage());
		} catch (\Exception $exception) {
				DB::rollBack();
			return back()->with('error', $exception->getMessage());
		}
        
    }

    // Show the form for editing a customer
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);  // Find customer by id
        return view('customers.edit', compact('customer'));
    }

    // Update the specified customer in the database
    public function update(Request $request, $id)
    {
        
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    // Delete a customer from the database
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
