<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class User_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user')->delete();
        User::create([
            'nama' => 'Dedi Lubis',
            'username' => 'admin',
            'password' =>bcrypt("admin"),
            'level' => 1,
            'kode_user' => 'OP-443',
            'status' => 1
        ]);
        User::create([
            'nama' => 'Muzanni',
            'username' => 'manager',
            'password' =>bcrypt("manager"),
            'level' => 4,
            'kode_user' => 'OP-473',
            'status' => 1
        ]);
   
        User::create([
            'nama' => 'Atika',
            'username' => 'pengurus',
            'password' =>bcrypt("pengurus"),
            'level' => 2,
            'kode_user' => 'OP-723',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Sumail',
            'username' => 'sumail',
            'password' =>bcrypt("sumail"),
            'level' => 3,
            'kode_user' => 'AG-341',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Dedi',
            'username' => 'anggota',
            'password' =>bcrypt("anggota"),
            'level' => 3,
            'kode_user' => 'AG-827',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Lumion',
            'username' => 'lumion',
            'password' =>bcrypt("lumion"),
            'level' => 3,
            'kode_user' => 'AG-365',
            'status' => 1
        ]);

    }
}
