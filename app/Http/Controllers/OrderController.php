<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
 

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getAllOrders();
        return view('orders.index', compact('orders'));
    }

    public function store(StoreOrderRequest $request) 
    {
        $data = $request->validate([
                    'client' => 'required',
                    'details' => 'required',
                ]);
        $created_order = $this->orderRepository->createOrder( $data);
        return redirect()->back();
    }
    
    public function temp(Request $request)
    {
        return redirect()->back();
    }

    public function one()
    {
        return response()->json([], 200);
    }
    // public function store(Request $request) 
    // {
    //     $data = $request->validate([
    //         'client' => 'required',
    //         'details' => 'required',
    //     ]);
        
    //     $created_order = $this->orderRepository->createOrder($data);
        
    //     return redirect()->back();
    // }

    public function show($id) 
    {
        $order = $this->orderRepository->getOrderById($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id) 
    {
        $order = $this->orderRepository->getOrderById($id);
        return view('orders.edit', compact('order'));
    }
    
    public function update(UpdateOrderRequest $request, $id) 
    {
        $orderId = $id;
        $data = $request->validate([
            'client' => 'required',
            'details' => 'required',
        ]);
        
        $this->orderRepository->updateOrder($id, $data);
        return redirect()->back();

        // return response()->json([
        //     'data' => $this->orderRepository->updateOrder($orderId, $orderDetails)
        // ]);
    }

    public function destroy($id) 
    {
        $this->orderRepository->deleteOrder($id);

        return redirect()->back();
    }

    public function create()
    {
      return view("orders.create");
    }

}
