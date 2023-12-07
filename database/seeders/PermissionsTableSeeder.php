<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_access',
            ],                  
            [
                'id'    => 2,
                'title' => 'config_access',
            ],
            [
                'id'    => 3,
                'title' => 'product_access',
            ],
            [
                'id'    => 4,
                'title' => 'customer_order_access',
            ],
            
        ];

        Permission::insert($permissions);
    }
}
