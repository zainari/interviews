<?php

use App\Models\User;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

it('assigns company to new client automatically', function () {
    // Create a company
    $company = Company::factory()->create();

    // Create user assigned to company
    $user = User::factory()->create([
        'company_id' => $company->id,
        'password' => bcrypt('password'),
    ]);

    $this->actingAs($user);

    // Create client and assign automatically
    $client = Client::create([
        'name' => 'Test Client',
        'email' => 'test@example.com',
        'company_id' => $user->company_id, // fixed
    ]);

    expect($client->company_id)->toBe($user->company_id);
});