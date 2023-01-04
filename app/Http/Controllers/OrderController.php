<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(){
        return $this->orderService->getAll();
    }
    public function createOrder(){
        return view('order.createOrder');
    }

    public function storeOrder(Request $request){
        return $this->orderService->create($request);
    }

    public function editOrder(Order $order){
        return view('order.updateOrder', ['order' =>$order]);
    }

    public function updateOrder(Request $request){
        return $this->orderService->update($request);
    }

     public function deleteOrder(Request $request){
        return $this->orderService->delete($request);
     }

//   public function deleteAllOrder():JsonResponse{
////       $this->orderRepository->deleteAllOrder();
//
//       return response()->json(null, Response::HTTP_NO_CONTENT);
//   }
}
