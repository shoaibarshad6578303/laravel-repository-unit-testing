<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThirdApiCallController extends Controller
{
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');
       
        if ($response->successful()) {
          return response()->json(['data' => $response->object()], $response->status());
        }
        
        return response()->json([
          'data' => null,
          'message' => 'Failed',
        ], 500);
    }
}
