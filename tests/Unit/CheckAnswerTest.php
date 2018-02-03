<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\PracticeController;


class CheckAnswerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(
            PracticeController::checkAnswer('   AhMeD','aHmEd   ')
        );
        
        $this->assertFalse(
            PracticeController::checkAnswer('Ahmed', 'Amhed')
        );
    }
}
