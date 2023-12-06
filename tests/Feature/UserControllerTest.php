<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
        ->assertSeeText('Masuk');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "martin"
        ])->get('/login')
        ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "martin",
            "password" => "rahasia"
        ])->assertRedirect("/")
        ->assertSessionHas("user", "martin");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "martin"
        ])->post('/login', [
            "user" => "martin",
            "password" => "rahasia"
        ])
        ->assertRedirect("/");
    }


    public function testLoginValidationError()
    {
        $this->post('/login', [])
        ->assertSeeText("User and password required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => "martin",
            'password' => "wrong"
        ])->assertSeeText("User or password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "martin"
        ])->post("/logout")
        ->assertRedirect("/")
        ->assertSessionMissing("user");
    }
}
