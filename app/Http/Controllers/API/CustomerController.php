<?php
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'dob'        => 'required|date',

        ]);

        $customer = Customer::create($validated);

        return response()->json(['message' => 'Customer created', 'data' => $customer], 201);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        
        
        $customer = Customer::find($id);

        // Check if customer exists
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }    
        $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email,' . $id,
                'dob'        => 'required|date'
            ]);

         $customer =   $customer->update($validated);

        return response()->json(['message' => 'Customer updated', 'data' => $customer,200]);
    }

    public function destroy($id)
    {
         
    try {
        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        // Delete the customer
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
        
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Customer not found with the given ID.',
        ], 404);
    }
    }
}
