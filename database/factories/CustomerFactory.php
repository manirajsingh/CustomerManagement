<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        $random = rand(3,78756);
        $email = 'john.doe@example.com';
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => $random.$email,
            'dob' => '1990-01-01',
        ];
    }
}
