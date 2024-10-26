<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = Role::create([

            'name'=>'Super Admin'
        ]);

        User::create([
            'first_name' => 'Likhoni',
            'last_name' => 'Jeedni',
            'role_id'=>$role->id,
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
            'phone_number' => '01725900442',
            'image' => '20241023073021.png',
            'address' => 'College Gate',
        ]);
    }
}
