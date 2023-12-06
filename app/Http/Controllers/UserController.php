<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function login(): Response {
        return response()->view("user.login", ["title" => "Masuk"]);
    }

    public function doLogin(Request $request): Response|RedirectResponse {
        $user = $request->input('user');
        $password = $request->input('password');

        //validate input
        if(empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User and password required"
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect("/");
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "User or password is wrong"
        ]);
    }

    public function doLogout() {

    }
}
