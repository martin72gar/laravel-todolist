<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "martin",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Martin"
                ],
                [
                    "id" => "2",
                    "todo" => "Siregar"
                ],                
            ],
        ])->get('/todolist')
        ->assertSeeText("1")
        ->assertSeeText("Martin")
        ->assertSeeText("2")
        ->assertSeeText("Siregar");
    }
}
