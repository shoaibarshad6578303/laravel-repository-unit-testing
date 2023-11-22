<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_createOrder()
    {
        $response = $this->json('POST','/api/orders', [
            'client' => "Nadeem",
            'details' => "Hi, I am nadeem"
        ]); 
        $response->assertStatus(302);
    }

    public function test_create_and_delete_order()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->json('POST','/api/orders', [
            'client' => "Nadeem",
            'details' => "Hi, I am nadeem"
        ]);   

        $response->assertStatus(302);
        
        $order = Order::where('client','Nadeem')->first();    
        $this->assertNotNull($order);

        $response = $this->get('/api/orders/'.$order->id);
        
        $response->assertStatus(200); 

        $response = $this->delete('/api/orders/'.$order->id);
        
        $response->assertStatus(302); 

        $response = $this->get('/api/orders/'.$order->id);
        
        $response->assertStatus(404); 
    }
    
    public function test_create_and_update_order()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->json('POST','/api/orders', [
            'client' => "Nadeem",
            'details' => "Hi, I am nadeem"
        ]);   

        $response->assertStatus(302);
        
        $order = Order::where('client','Nadeem')->first(); 
          
        $this->assertNotNull($order);

        $response = $this->get('/api/orders/'.$order->id);
        
        $response->assertStatus(200); 

        $response = $this->put('/api/orders/'.$order->id, ['client' => "now", 'details' => "yes this is"]);
        
        $response->assertStatus(302); 
    
        $update_order = Order::where('details', 'yes this is')->first();
        $this->assertNotNull($update_order);

        $this->assertEquals($update_order['client'], "NOW");
        
    }
    
    public function test_create_order_detail_missing()
    {
        $response = $this->json('POST','/api/orders', [
            'client' => "Nadeem",
        ])->assertUnprocessable();   
        
        $response->assertJsonValidationErrors(['details']);
    }

    public function test_create_order_client_missing()
    {
        $response = $this->json('POST','/api/orders', [
            'details' => "Hi, I am nadeem"
        ])->assertUnprocessable();   
        
        $response->assertJsonValidationErrors(['client']);
    }

    public function test_update_order_detail_missing()
    {
        $response = $this->json('put','/api/orders/1', [
            'client' => "Nadeem",
        ])->assertUnprocessable();   
        
        $response->assertJsonValidationErrors(['details']);
    }

    public function test_update_order_client_missing()
    {
        $response = $this->json('put','/api/orders/1', [
            'details' => "Hi, I am nadeem"
        ])->assertUnprocessable();   
        
        $response->assertJsonValidationErrors(['client']);
    }
}
