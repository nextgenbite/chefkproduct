<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'catgory.create']);
        Permission::create(['name' => 'catgory.update']);
        Permission::create(['name' => 'catgory.delete']);
    }
}
