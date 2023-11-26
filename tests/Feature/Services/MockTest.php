<?php

namespace Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\services\MockTestService;
use App\services\ClassUnderTest;
use Mockery\MockInterface;

class MockTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_name()
    {

        $stub = $this->mock(MockTestService::class, function(MockInterface $mock){
            $mock->shouldReceive('getName')
            ->andReturn('abc');
        });

        $this->assertSame('abc', $stub->getName());

    }
}
