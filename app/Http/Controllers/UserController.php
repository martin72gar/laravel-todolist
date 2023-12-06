<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(): Response {
        return response()->view("user.login", ["title" => "Masuk"]);
    }

    public function doLogin() {

    }

    public function doLogout() {

    }
}
