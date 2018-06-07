<?php

use App\User;
use Illuminate\Database\Seeder;
use Star\MCenter\Models\Organization;
use Star\MCenter\Models\Permission;
use Star\MCenter\Models\Role;
use Star\MCenter\Services\MCenter;

class MCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建部门
        $office = Organization::create([
            'name' => '办公室',
        ]);
        //根据icenter模块机制（.json文件）创建菜单及权限
        MCenter::makeMenus();

        //创建管理员角色
        $adminRole = Role::create([
            'name' => 'root',
            'label' => '管理员',
        ]);

        $userRole = Role::create([
            'name' => 'manager',
            'label' => '普通管理人员',
        ]);

        $permissionList = Permission::all();
        $userRole->givePermissionTo('general');

        foreach ($permissionList as $permission) {
            $adminRole->givePermissionTo($permission['name']);
        }
        // 创建默认管理员
        $admin = User::create([
            'name' => '刘德华',
            'mobile' => '18688889999',
            'password' => bcrypt('password'),
            'email' => 'admin@stario.net',
        ]);
        $partoo = User::create([
            'name' => '郭富城',
            'mobile' => '18669783161',
            'password' => bcrypt('password'),
            'email' => 'partoo@163.com',
        ]);

        $admin->assignRole('root');
        $partoo->assignRole('manager');

        // 关联用户和部门
        $office->users()->save($admin);

    }
}
