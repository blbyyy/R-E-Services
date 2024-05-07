<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->fname = 'Laarnie';
        $user->lname = 'Macapagal';
        $user->mname = 'D';
        $user->role = 'Admin';
        $user->save();

        $staff = new Staff;
        $staff->fname = 'Laarnie';
        $staff->lname = 'Macapagal';
        $staff->mname = 'D';
        $staff->position = 'Unknwon';
        $staff->designation = 'Unknwon';
        $staff->tup_id = '43656348657';
        $staff->email = 'laarnie@gmail.com';
        $staff->gender = 'Female';
        $staff->phone = '364576597659';
        $staff->address = 'Taguig City';
        $staff->birthdate = '2024-05-08';
        $staff->user_id = $user->id;
        $staff->save();
    }
}
