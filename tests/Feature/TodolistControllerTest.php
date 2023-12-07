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

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "martin"
        ])->post("/todolist", [])
        ->assertSeeText("Can't add empty Todo!");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "martin"
        ])->post("/todolist", [
            "todo" => "Martin"
        ])
        ->assertRedirect("/todolist");
    }

    public function testDeleteTodo()
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
        ])->post('/todolist/1/delete')
        ->assertRedirect("/todolist");
    }
}
