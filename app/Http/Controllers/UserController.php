<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::find(1);
        foreach ($users->userDetail as $item) {
            dd($users->userDetail->first_name);
        }
    }
}
