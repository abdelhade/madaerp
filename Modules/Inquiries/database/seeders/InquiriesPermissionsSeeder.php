<?php

namespace Modules\Inquiries\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Authorization\Models\Permission;
use Modules\Authorization\Models\Role;

class InquiriesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // === 1. تعريف الصلاحيات باللغة العربية ===
        $groupedPermissions = [
            'الاستفسارات' => [
                'الاستفسار',             
                'تفاصيل الاستفسار',     
                'التقييم والدرجة',      
                'التعليق',             
                'المرفق',              
                'التصدير',             
                'التقرير',              
            ],
            'أصحاب المصلحة (استفسارات)' => [
                'عملاء الاستفسارات',    
                'المقاولون الرئيسيون', 
                'الاستشاريون',          
                'الملاك',               
            ],
            'بيانات الاستفسارات الاساسية' => [
                'أحجام المشاريع',
                'أولوية KON',
                'أولوية العميل',
                'مصادر الاستفسار',
                'تصنيفات العمل',
            ],
            'المطلوبات والشروط (استفسارات)' => [
                'قائمة المطلوب تقديمها',
                'شروط العمل',
            ],
            'مستندات الاستفسارات' => [
                'مستندات المشروع',
            ],
            'تقييم الاستفسارات' => [
                'حساب الدرجة',
                'مستوى الصعوبة',
            ],
        ];

        // === 2. تعريف الأفعال ===
        $actions = ['عرض', 'إضافة', 'تعديل', 'حذف', 'طباعة'];

        foreach ($groupedPermissions as $category => $items) {
            foreach ($items as $base) {
                if (str_contains($base, ' ') || in_array($category, [
                    'بيانات الاستفسارات الاساسية',
                    'المطلوبات والشروط (استفسارات)',
                    'مستندات الاستفسارات',
                    'تقييم الاستفسارات'
                ])) {
                    Permission::firstOrCreate(
                        ['name' => $base, 'guard_name' => 'web'],
                        ['category' => $category]
                    );
                } else {
                    foreach ($actions as $action) {
                        $name = "$action $base";
                        Permission::firstOrCreate(
                            ['name' => $name, 'guard_name' => 'web'],
                            ['category' => $category]
                        );
                    }
                }
            }
        }

        // صلاحية خاصة
        Permission::firstOrCreate(
            ['name' => 'تغيير حالة الاستفسار', 'guard_name' => 'web'],
            ['category' => 'الاستفسارات']
        );

        // === 3. الأدوار ===
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        $estimator = Role::firstOrCreate(['name' => 'estimator', 'guard_name' => 'web']);
        $estimator->syncPermissions([
            'عرض الاستفسار',
            'إضافة الاستفسار',
            'تعديل الاستفسار',
            'تفاصيل الاستفسار',
            'تغيير حالة الاستفسار',
            'عرض التعليق',
            'إضافة التعليق',
            'تعديل التعليق',
            'حذف التعليق',
            'عرض المرفق',
            'إضافة المرفق',
            'حذف المرفق',
        ]);

        $manager = Role::firstOrCreate(['name' => 'project manager', 'guard_name' => 'web']);
        $manager->syncPermissions([
            'عرض الاستفسار',
            'تعديل الاستفسار',
            'عرض التقرير',
        ]);
    }
}
