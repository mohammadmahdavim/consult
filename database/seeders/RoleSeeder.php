<?php

namespace Database\Seeders;

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
        $permissions = \Spatie\Permission\Models\Permission::all();
        $superpermissions = [];
        foreach ($permissions as $permission) {
            $superpermissions[] = $permission->name;
        }
        $lists = [
            0 => [
                'name' => 'super-admin',
                'label' => 'یزنامه نویس',
                'permissions' => $superpermissions
            ],
            1 => [
                'name' => 'admin',
                'label' => 'مدیر',
                'permissions' => [
                    'finance',
                    'site',
                    'slider',
                    'service',
                    'service-show',
                    'blog',
                    'about',
                    'contact',
                    'finance-list',
                    'finance-create',
                    'finance-consult',
                    'consult-list',
                    'consult-create',
                    'consult-show',
                    'student-list',
                    'student-create',
                    'student-delete',
                    'student-update',
                    'call-list',
                    'call-create',
                    'content-list',
                    'content-create',
                    'content-show',
                    'program-list',
                    'program-create',
                    'program-show',
                    'service-show-student',
                    'service-create-student',
                    'finance-student-show',
                    'user-list',
                    'caller-finance',
                    'update-site',
                    'notif-student',
                ]
            ],
            2 => [
                'name' => 'consult',
                'label' => 'مشاور',
                'permissions' => [
                    'service-show',
                    'finance-consult',
                    'consult-show',
                    'student-list',
                    'call-list',
                    'call-create',
                    'content-list',
                    'content-create',
                    'content-show',
                    'program-list',
                    'program-create',
                    'program-show',
                    'finance-consult-show',
                    'service-show-student',
                    'notif-student',
                    'student-update'
                ]
            ],
            3 => [
                'name' => 'student',
                'label' => 'دانش آموز',
                'permissions' => [
                    'service-show',
                    'service-show-student',
                    'finance-student-show',
                    'consult-show',
                    'content-list',
                    'content-show',
                    'program-show',
                    'program-show-student',
                    'consult-show-student',
                    'notif-student',
                    'student-finance-single'
                ]
            ],
            4 => [
                'name' => 'caller',
                'label' => 'جذب کننده',
                'permissions' => [
                    'consult-list',
                    'student-list',
                    'service-show-student',
                    'service-create-student',
                    'caller-finance',
                    'caller-finance-single'
                ]
            ],
            5 => [
                'name' => 'semi_admin',
                'label' => 'مدیر کوچک',
                'permissions' => [
                    'site',
                    'slider',
                    'service',
                    'service-show',
                    'blog',
                    'about',
                    'contact',
                    'consult-list',
                    'consult-create',
                    'consult-show',
                    'student-list',
                    'student-create',
                    'student-delete',
                    'student-update',
                    'call-list',
                    'call-create',
                    'content-list',
                    'content-create',
                    'content-show',
                    'program-list',
                    'program-create',
                    'program-show',
                    'service-show-student',
                    'service-create-student',
                    'user-list',
                    'update-site',
                    'notif-student',
                ]
            ],

        ];
        foreach ($lists as $item) {
            $role = \Spatie\Permission\Models\Role::where('name', $item['name'])->first();
            if (!$role) {
                $role = \Spatie\Permission\Models\Role::create([
                    'name' => $item['name'],
                ]);
            }
            $ids = [];
            foreach ($item['permissions'] as $permission) {
                $secret = \Spatie\Permission\Models\Permission::where('name', $permission)->pluck('id')->first();
                if ($secret) {
                    $ids[] = $secret;
                }
            }
            $role->syncPermissions($ids);
        }
    }
}
