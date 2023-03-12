<?php

use Illuminate\Database\Seeder;
use App\Model\Admin;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('admin.admin_name')) {
            Admin::firstOrCreate(
                ['employee_id' => config('admin.employee_id')], [
                    'name' => config('admin.admin_name'),
                    'designation' => config('admin.designation'),
                    'doj' => config('admin.doj'),
                    'password' => bcrypt(config('admin.password')),
                ]
            );
        }
    }
}
