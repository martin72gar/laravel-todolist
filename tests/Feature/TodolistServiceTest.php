<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp():void
    {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Martin");

        $todolist = Session::get("todolist");
        foreach ($todolist as $value) {
            self::assertEquals("1", $value['id']);
            self::assertEquals("Martin", $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Martin"
            ],
            [
                "id" => "2",
                "todo" => "Siregar"
            ]
        ];

        $this->todolistService->saveTodo("1", "Martin");
        $this->todolistService->saveTodo("2", "Siregar");

        self::assertEquals($expected, $this->todolistService->getTodolist());
    }
}
