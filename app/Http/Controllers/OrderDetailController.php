<?php

namespace App\Http\Controllers;

use App\OrderDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class OrderDetailController extends ApiController
{
    private $orderDetail; 

    public function __construct(OrderDetail $orderDetail) 
    {
        $this->orderDetail = $orderDetail; 
    }

    public function store(Request $request) 
    {
        $rule = [
            'product_id'    => 'required',
            'order_id'      => 'required', 
            'quantity'      => 'required'
        ];

        $this->validate($request, $rule); 

        $orderDetail = $this->orderDetail->create([
            'quantity'      => $request->quantity, 
            'product_id'    => $request->product_id, 
            'order_id'      => $request->order_id
        ]);

        return $this->showResponse($orderDetail);
    }

    public function getProduct($id) {
        $product = $this->orderDetail->findOrFail($id)->product;

        return $this->showResponse($product);
    }

    public function done($id) {
        $orderDetail = $this->orderDetail->findOrFail($id); 
        $orderDetail->status = $this->orderDetail->UNAVAILABLE; 
        return $this->updatedResponse($orderDetail);
    }
}
