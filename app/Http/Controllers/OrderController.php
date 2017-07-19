<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class OrderController extends ApiController
{
    private $order; 

    public function __construct(Order $order) 
    {
        $this->order = $order; 
    }

    public function getAll() 
    {
        $orders = $this->order->all(); 

        return $this->listResponse($orders);
    }

    public function store(Request $request)
    {   
        $user = $this->getAuthUser($request->token); 

        $rule = [
            'phone_number'  => 'required', 
            'place_id'      => 'required'
        ]; 

        $this->validate($request, $rule);

        $order = $this->order->create([
            'user_id'       => $user->id,
            'place_id'      => $request->place_id,
            'phone_number'  => $request->phone_number
        ]); 

        return $this->showResponse($order); 
    }

    public function getOrderDetails($id) 
    {
        $order = $this->order->findOrFail($id); 
        $orderDetailsJson = []; 

        $orderDetails = $order->orderDetails;
        foreach ($orderDetails as $orderDetail) {
            $product = $orderDetail->product;
            array_push($orderDetailsJson, $orderDetail);
        }

       return $this->listResponse($orderDetailsJson);
    }
}
