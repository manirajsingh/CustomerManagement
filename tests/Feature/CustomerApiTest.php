<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
     public function test_create_customer_validation()
    {
        $response = $this->json('POST', '/api/customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $response->assertStatus(422) 
                 ->assertJsonValidationErrors(['email']); 
    }

    public function test_create_customer()
    {
        $random =  rand(4,1099);
        $email = $random.'johnddoed@example.com';
        $response = $this->postJson('/api/customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => $email,
            'dob' => '2020-05-10'
        ]);

        $response->assertStatus(201); // 201 Created
        $response->assertJsonFragment([
            'message' => 'Customer created',
        ]);

        $response->assertJsonFragment([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => $email,
        'dob' => '2020-05-10'
        ]);
    }


    public function test_delete_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/customers/{$customer->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Customer deleted successfully'
                 ]);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id
        ]);
    }

    public function test_update_customer_validation()
    {
        // Create a customer
        $customer = Customer::factory()->create();

        $random =  rand(4,1099);
        $email = $random.'johnddoed@example.com';
        $updatedData = [
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => $email,
            'dob'        => '1990-05-10',
        ];

        $response = $this->json('PUT', '/api/customers/' . $customer->id, $updatedData);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'message' => 'Customer updated',
        ]);

        $this->assertDatabaseHas('customers', [
            'id'         => $customer->id,
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => $email,
            'dob'        => '1990-05-10',
        ]);
}
    public function test_get_all_customers()
    {
        $customers = Customer::factory()->count(3)->create();

        $response = $this->json('GET', '/api/customers');

        $response->assertStatus(200);   

        foreach ($customers as $customer) {
            $response->assertJsonFragment([
                'id'         => $customer->id,
                'first_name' => $customer->first_name,
                'last_name'  => $customer->last_name,
                'email'      => $customer->email,
                'dob'        => $customer->dob,
            ]);
        }
    }

}