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
        // DB::table('tbl_user')->delete();
        User::create([
            'nama' => 'Dedi Lubis',
            'username' => 'admin',
            'password' =>bcrypt("admin"),
            'level' => 1,
            'kode_user' => 'AD-443',
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
    }
}
