<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\OrderReponsitory;

class OrderService
{
    public function __construct(OrderReponsitory $orderReponsitory){
        $this->orderRepository = $orderReponsitory;
    }

    public function getAll(){
        return view('order.index', ['orders' => $this->orderRepository->getAllOrders()]);
    }

    public function create(Request $request){
        $orderDetails = $request->only([
            'name',
            'description'
        ]);

        return $this->orderRepository->storeOrder($orderDetails);
    }

    public function update(Request $request){
        $id = $request->route('id');
        $attributes = $request->only([
            'name',
            'description'
        ]);
        return $this->orderRepository->updateOrder($id, $attributes);
    }

    public function delete(Request $request){
        $orderId = $request->route('id');
       $this->orderRepository->deleteOrder($orderId);

        return redirect('/order');
    }
}
