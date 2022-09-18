<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Http\Client\Request;



class ThirdApiCallContrllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_get_fake_api()
    {

        Http::fake([
            'https://jsonplaceholder.typicode.com/todos/1/*' => Http::response([
                'data' => [
                    'id' => 1,
                    'employee_name' => 'Tiger Nixon',
                    'employee_salary' => 320800,
                    'employee_age' => 61,
                ],
            ], 200)
        ]);

        // Now we can make our assertions that the endpoint will provide us with the data we expect
        $this->json('get', '/api/example')
            ->assertOk()
            ->assertJson(fn(AssertableJson $json) =>
                $json->has('data', fn($json) =>
                        $json->has('id')
                            ->where('employee_name', 'Tiger Nixon')
                            ->where('employee_salary', 320800)
                            ->where('employee_age', 61)
                            ->etc()));
        
    }

    public function test_post_api(){

        Http::fake();
 
        Http::withHeaders([
            'X-First' => 'foo',
        ])->post('http://example.com/users*', [
            'name' => 'Taylor',
            'role' => 'Developer',
        ]);
        
        Http::assertSent(function ($request) {    
            return $request->hasHeader('X-First', 'foo') &&
                $request->url() == 'http://example.com/users*' &&
                $request['name'] == 'Taylor' &&
                $request['role'] == 'Developer';
        });
    }

    // public function test_making_an_api_request()
    // {
    //     $response = $this->postJson('/api/user', ['name' => 'Sally']);
 
    //     $response
    //         ->assertStatus(201)
    //         ->assertJson([
    //             'created' => true,
    //         ]);
    // }

    public function test_third_party_api_get_test()
    {
        Http::fake();
        $response = Http::get('http://example.com/users*');
        $this->assertEquals(200, $response->status());
    }
}
