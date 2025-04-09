<?php

namespace Database\Seeders;

use App\Models\SiteSettings;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Roles creation
        $adminRole = Role::create(['name' => 'Administrator']);
        $userRole = Role::create(['name' => 'User']);

        //all resources controller permissions
        $resourcePermissions = [
            ['name' => 'users', 'controller' => 'UsersController', 'roles' => [$adminRole]],
            ['name' => 'role-permission', 'controller' => 'RolePermissionController', 'roles' => [$adminRole]],
            ['name' => 'permission-listing', 'controller' => 'PermissionListingController', 'roles' => [$adminRole]],
            ['name' => 'dashboard', 'controller' => 'DashboardController', 'roles' => [$adminRole, $userRole]],
            ['name' => 'profile', 'controller' => 'ProfileController', 'roles' => [$adminRole, $userRole]],
            ['name' => 'branch', 'controller' => 'BranchController', 'roles' => [$adminRole]],
            ['name' => 'department', 'controller' => 'DepartmentController', 'roles' => [$adminRole]],
            ['name' => 'subject', 'controller' => 'SubjectController', 'roles' => [$adminRole]],
            ['name' => 'inward-letter', 'controller' => 'InwardLetterController', 'roles' => [$adminRole]],
            ['name' => 'outward-letter', 'controller' => 'OutwardLetterController', 'roles' => [$adminRole]],
            ['name' => 'case', 'controller' => 'CaseController', 'roles' => [$adminRole]],
        ];

        foreach ($resourcePermissions as $resource) {
            $permissionInstances = $this->createResourcePermissions($resource['name'], $resource['controller']);
            foreach ($resource['roles'] as $role) {
                $role->givePermissionTo($permissionInstances);
            }
        }

        $singlePermissions = [
            // ['name' => 'holiday.import', 'controller' => 'OrganizationHolidaysController', 'roles' => [$adminRole]],
        ];

        foreach ($singlePermissions as $single) {
            $permission = Permission::firstOrCreate([
                'name' => $single['name'],
            ], [
                'controller' => $single['controller'],
            ]);
            foreach ($single['roles'] as $role) {
                if (!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }
        }

        //other seeders
        $this->call([
            CountriesSeeder::class,
        ]);
        //while in development only
        // SiteSettings::create([
        //     'appkey' => config('app.key'),
        //     'title' => "MB Super",
        //     'logo' => "public/images/logo.svg",
        //     'favicon' => "public/images/favicon-32x32.png",
        //     'copyright' => "© All rights reserved",
        // ]);
        // $user = User::create([
        //     'name' => "Mayank Bhandure",
        //     'email' => "mayu.bhandure657@gmail.com",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('12345'),
        // ]);
        // $user->assignRole($adminRole);
    }

    private function createResourcePermissions($resourceName, $controllerName)
    {
        $actions = ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show'];
        $permissions = [];
        foreach ($actions as $action) {
            $permissionName = "{$resourceName}.{$action}";
            $permissions[] = Permission::firstOrCreate([
                'name' => $permissionName,
                'controller' => $controllerName,
            ]);
        }
        return $permissions;
    }
}
