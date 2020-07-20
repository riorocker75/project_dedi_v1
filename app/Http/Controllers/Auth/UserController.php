<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\Anggota;
use App\Model\Operator;

use App\Model\User;

class UserController extends Controller
{
   
    // function tes(){
    // 	$nama = "anggota";
    // 	$cek=Hash::make($nama);
    // 	echo "operator" ."<br>";
    // 	return $cek;
    // }

}
