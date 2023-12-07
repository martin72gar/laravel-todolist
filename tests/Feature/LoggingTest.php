<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    public function testLogging()
    {
        Log::info("Hello info");
        Log::warning("Hello warning");
        Log::error("Hello error");
        Log::critical("Hello critical");

        self::assertTrue(true);
    }
}
