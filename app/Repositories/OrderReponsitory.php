<?php

namespace App\Repositories;

use App\Models\Order;

class OrderReponsitory extends BaseRepository {

    public function getModel()
    {
        return Order::class;
    }

    public function getAllOrders(){
//        return Order::all();
        return $this->getAll();
//        return $this ->_model::all();
    }

    public function storeOrder(array $orderDetails){
//        Order::create($orderDetails);
//        $this->_model->create($orderDetails);
          $this->create($orderDetails);

        return redirect('/order');
    }

    public function updateOrder($id, array $attributes){
        $OrderId = Order::findOrFail($id);
//        Order::whereId($orderId)->update($newDetails);
//        $this->_model->update($id, $attributes);
        $OrderId->update($attributes);

        return redirect('/order');
    }

    public function deleteOrder($productId){
//        Order::destroy($productId);

        $this->delete($productId);

        return redirect('/order');
    }

    public function deleteAllOrder(){
        Order::query()->delete();
    }
}
