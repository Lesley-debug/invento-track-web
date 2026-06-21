<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        $plan = Plan::firstOrCreate(
            ['name' => 'Starter'],
            [
                'price_monthly' => 9,
                'price_yearly' => 90,
                'max_users' => 2,
                'max_products' => 500,
                'max_locations' => 1,
            ]
        );

        $tenant = Tenant::firstOrCreate(
            ['slug' => 'test-supermarket'],
            [
                'plan_id' => $plan->id,
                'name' => 'Test Supermarket',
                'currency' => 'XAF',
                'timezone' => 'Africa/Douala',
            ]
        );

        $this->command->info('Plan: ' . $plan->name . ' (' . $plan->id . ')');
        $this->command->info('Tenant: ' . $tenant->name . ' (' . $tenant->id . ')');
        $this->command->info('Tenant->Plan relationship: ' . $tenant->plan->name);
    }
}
