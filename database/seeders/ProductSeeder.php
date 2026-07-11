<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if(!$user){

            $user = User::factory()->create();

        }

        Product::create([

            'user_id'=>$user->id,

            'name'=>'iPhone XR 128GB',

            'description'=>'iPhone XR bekas masih mulus, Face ID normal.',

            'price'=>3500000,

            'category'=>'Elektronik',

            'condition'=>'Bekas',

            'image'=>'products/default.jpg',

            'stock'=>1,

            'status'=>'available'

        ]);

        Product::create([

            'user_id'=>$user->id,

            'name'=>'Tas Eiger',

            'description'=>'Tas outdoor original kondisi 90%.',

            'price'=>250000,

            'category'=>'Tas',

            'condition'=>'Bekas',

            'image'=>'products/default.jpg',

            'stock'=>2,

            'status'=>'available'

        ]);

        Product::factory(18)->create([
            'user_id'=>$user->id
        ]);
    }
}