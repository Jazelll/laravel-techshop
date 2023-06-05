<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::factory()->create([
            'name'=>'Althea Rito',
            'email'=>'althearito@gmail.com.com',
            'password'=>bcrypt("althearito123"),
        ]);

        Product::create([
            'name'=>'Nike Shoes',
            'seller_id'=>$user->id(),
            'seller_id'=>$user->id,
            'price'=>5000.99,
            'description' => 'Size: 40, 41',
        ]);


        Product::create([
            'name'=>'Vans Shoes',
            'seller_id'=>$user->id(),
            'seller_id'=>$user->id,
            'price'=>4000.99,
            'description' => 'Size: 40, 41',
        ]);
    }
}