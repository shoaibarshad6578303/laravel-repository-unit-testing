<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\services\Sum;

class SumTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_sum_passed()
    {
        $sum = new Sum();
        $this->assertEquals(7, $sum->sum(3, 4));
    }

    public function test_sum_failed()
    {
        $sum = new Sum();
        $this->assertNotEquals(10, $sum->sum(3, 4));
    }
}
