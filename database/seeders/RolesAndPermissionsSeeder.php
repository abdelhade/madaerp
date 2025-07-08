<?php

namespace Modules\Authorization\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Models\Role;
use Modules\Authorization\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // حذف الكاش
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // لو حابب تعيد تعيين الجدول امسح التعليقات من هنا:
        // Permission::truncate();
        // Role::truncate();

        // الصلاحيات مع تقسيم حسب الفئة (category)
        $groupedPermissions = [
            'users' => [
                'view users',
                'create users',
                'edit users',
                'delete users',
            ],
            'roles' => [
                'view roles',
                'create roles',
                'edit roles',
                'delete roles',
            ],
            'products' => [
                'view products',
                'add products',
                'edit products',
                'delete products',
            ],
            'orders' => [
                'view orders',
                'create orders',
                'edit orders',
                'delete orders',
            ],

            'fire' => [
                'vie5w orders',
                'crea5te orders',
                'edit5 orders',
                'del5ete orders',
            ],
        ];

        foreach ($groupedPermissions as $category => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(
                    [
                        'name' => $permission,
                        'guard_name' => 'web',
                        'category' => $category
                    ]
                );
            }
        }

        // أدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user'], ['guard_name' => 'web']);
        // ربط صلاحيات بالأدوار
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['view users']);
    }
}
