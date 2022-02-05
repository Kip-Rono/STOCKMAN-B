<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //fetch users
    public function fetchUsers(Request $request)
    {
        $password = hash('MD5',$request->password);

        $user = Users::where('name', $request->name)->where('password', $password)->get();

        return $user;
    }
}
