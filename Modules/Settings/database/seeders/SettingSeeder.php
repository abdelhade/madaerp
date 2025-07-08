<?php

namespace Modules\Settings\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Models\Category;
use Modules\Settings\Models\PublicSetting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $general = Category::create(['name' => 'الثوابت العامه']);
        $invoices = Category::create(['name' => 'ثوابت الفواتير']);
        $accounts = Category::create(['name' => 'حساب الخصم المكتسب ']);

        PublicSetting::create([
            'category_id' => $general->id,
            'label' => 'اسم الشركه',
            'key' => 'campany_name',
            'input_type' => 'text',
            'value' => 'الشركه',
        ]);

        PublicSetting::create([
            'category_id' => $general->id,
            'label' => 'تاريخ بدايه المده',
            'key' => 'start_date',
            'input_type' => 'date',
            'value' => '2023-01-01',
        ]);

        PublicSetting::create([
            'category_id' => $general->id,
            'label' => 'تاريخ نهاية المده',
            'key' => 'start_date',
            'input_type' => 'date',
            'value' => '2023-01-01',
        ]);

        PublicSetting::create([
            'category_id' => $general->id,
            'label' => 'العنوان',
            'key' => 'address',
            'input_type' => 'text',
            'value' => '123 شارع المثال، المدينة، الدولة',
        ]);

        PublicSetting::create([
            'category_id' => $general->id,
            'label' => 'البريد الإلكتروني',
            'key' => 'email',
            'input_type' => 'email',
            'value' => 'ثمثال@example.com',
        ]);

        PublicSetting::create([
            'category_id' => $invoices->id,
            'label' => 'حساب اضافي الموظفين',
            'key' => 'employee_adding_account',
            'input_type' => 'integer',
            'value' => '123456789',
        ]);

        PublicSetting::create([
            'category_id' => $invoices->id,
            'label' => 'حساب رواتب الموظفين',
            'key' => 'employee_salary_account',
            'input_type' => 'integer',
            'value' => '123456789',
        ]);

        PublicSetting::create([
            'category_id' => $invoices->id,
            'label' => 'حساب خصم الموظفين',
            'key' => 'employee_discount_account',
            'input_type' => 'integer',
            'value' => '123456789',
        ]);

        PublicSetting::create([
            'category_id' => $accounts->id,
            'label' => 'حساب الخصم المسموح به ',
            'key' => 'allowed_discount_account',
            'input_type' => 'integer',
            'value' => '123456789',
        ]);
    }
}
