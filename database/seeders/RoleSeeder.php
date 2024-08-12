<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Create roles
$roleSuperAdmin = Role::create(['guard_name' => 'web', 'name' => 'superadmin']);
$roleVendor = Role::create(['guard_name' => 'web', 'name' => 'vendor']);
$roleCustomer = Role::create(['guard_name' => 'web', 'name' => 'customer']);

// Define permissions
$permissions = [
    'dashboard' => ['dashboard.view'],
    'pos' => ['pos.view'],
    'category' => ['category.view', 'category.create', 'category.edit', 'category.delete'],
    'subcategory' => ['subcategory.view', 'subcategory.create', 'subcategory.edit', 'subcategory.delete'],
    'brand' => ['brand.view', 'brand.create', 'brand.edit', 'brand.delete'],
    'attribute' => ['attribute.view', 'attribute.create', 'attribute.edit', 'attribute.delete'],
    'shipping_cost' => ['shipping_cost.view', 'shipping_cost.create', 'shipping_cost.edit', 'shipping_cost.delete'],
    'product' => ['product.view', 'product.create', 'product.edit', 'product.delete'],
    'order' => ['order.view', 'order.delete', 'order.edit'],
    'rating_review' => ['rating_review.view', 'rating_review.delete'],
    'user' => ['user.view', 'user.create', 'user.edit', 'user.delete'],
    'role' => ['role.view', 'role.create', 'role.edit', 'role.delete'],
    'admin' => ['admin.view', 'admin.create', 'admin.edit', 'admin.delete'],
    'page' => ['page.view', 'page.create', 'page.edit', 'page.delete'],
    'slider' => ['slider.view', 'slider.create', 'slider.edit', 'slider.delete'],
    'site_setting' => ['site_setting.view', 'site_setting.edit'],
    'setting' => ['setting.view', 'setting.edit'],
    'profile' => ['profile.view', 'profile.edit'],
    'report_stock' => ['report_stock.view', 'report_stock.create', 'report_stock.edit', 'report_stock.delete'],
];

// Assign permissions to the superadmin role
foreach ($permissions as $group => $groupPermissions) {
    foreach ($groupPermissions as $permissionName) {
        $permission = Permission::create([
            'group_name' => $group,
            'guard_name' => 'web',
            'name' => $permissionName,
        ]);

        // $roleSuperAdmin->givePermissionTo($permission);
    }
}

// Assign the superadmin role to specific users (e.g., super admins)
// $superAdminUser = User::find(1); // Replace with the actual user ID
// $superAdminUser->assignRole($roleSuperAdmin);
}


}
