<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;



class CustomerApiTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

      public function test_customer_api_requires_authentication()
    {
        $response = $this->json('GET', '/api/customers');

        $response->assertStatus(401);
    }




}
