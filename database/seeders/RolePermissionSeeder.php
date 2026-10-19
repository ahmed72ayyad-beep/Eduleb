<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [

            // Courses
            'courses.view',
            'courses.create',
            'courses.update',
            'courses.delete',


            // Users
            'users.view',
            'users.create',
            'users.update',
            'users.delete',


            // Instructors

            'instructors.view',
            'instructors.create',
            'instructors.update',
            'instructors.delete',


            // Reviews
            'reviews.view',
            'reviews.create',
            'reviews.delete',

            // Categories
            'categories.view',
            'categories.create',
            'categories.update',
            'categories.delete',

            // Posts / Blog
            'blogs.view',
            'blogs.create',
            'blogs.update',
            'blogs.delete',
            // Comments / Blog
            'blogs.comments.view',
            'blogs.comments.create',
            'blogs.comments.update',
            'blogs.comments.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }


        // Roles

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $instructor = Role::firstOrCreate([
            'name' => 'instructor',
            'guard_name' => 'web',
        ]);

        $writer = Role::firstOrCreate([
            'name' => 'writer',
            'guard_name' => 'web',
        ]);

        $student = Role::firstOrCreate([
            'name' => 'student',
            'guard_name' => 'web',
        ]);


        // Admin Permissions

        $admin->syncPermissions(
          $permissions
        );


        // Instructor Permissions

        $instructor->syncPermissions([
            'courses.view',
            'courses.create',
            'courses.update',
            'instructors.view',
            'reviews.view',
        ]);


        // Writer Permissions

        $writer->syncPermissions([
            'blogs.view',
            'blogs.create',
            'blogs.update',
            'blogs.delete',
            'courses.view',
            'reviews.view',
            'categories.view',
            'blogs.comments.view',
            'instructors.view',


        ]);


        // Student Permissions

        $student->syncPermissions([
            'courses.view',
            'blogs.comments.view',
            'reviews.view',
            'instructors.view',
            'reviews.create',


        ]);
    }
}
