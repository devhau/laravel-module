<?php

namespace DevHau\Modules\Database\Seeders;

use DevHau\Modules\PermissionLoader;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        PermissionLoader::UpdatePermission();
        $roleAdmin = config('devhau-module.auth.role', \DevHau\Modules\Models\Role::class)::create([
            'name' => \DevHau\Modules\Providers\AuthServiceProvider::RoleAdmin,
            'slug' => \DevHau\Modules\Providers\AuthServiceProvider::RoleAdmin
        ]);
        $userAdmin =  config('devhau-module.auth.user', \DevHau\Modules\Models\User::class)::create([
            'slug' => 'nguyen-van-hau',
            'status' => 'Loading...',
            'info' => 'Hello any,',
            'name' => 'Nguyễn Văn Hậu',
            'email' => 'admin@hau.xyz',
            'password' => Hash::make('Admin@123@1234'),
        ]);
        $userAdmin->roles()->sync([$roleAdmin->id]);
    }
}
