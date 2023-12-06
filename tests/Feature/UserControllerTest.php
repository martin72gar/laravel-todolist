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

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "martin",
            "password" => "rahasia"
        ])->assertRedirect("/")
        ->assertSessionHas("user", "martin");
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
}
