<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

         User::factory()->create([
            'name' => 'Rodrigo',
            'last_name' => 'Ramirez',
            'document_type' => 1,
            'document_number' => '4786912',
            'phone' => '0972226375',
            'email' => 'rodrigo@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            FamilySeeder::class,    
            OptionSeeder::class
        ]);

        Product::factory(5)->create();
    }
}
