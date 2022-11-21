<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends BaseController {
    public $model = Orders::class;
    public function getOrder() {
        $orders = $this->index(['rUsers']);
        return view('adminPage.orders', compact('orders'));
    }

    public function updateOrder(Request $request, $id) {
        $order = $this->update($request, $id, false);
        $isSuccess = true;
        $orders = Orders::where('status', 1)->get();
        return view('adminPage.ordersEdit', compact('order', 'orders', 'isSuccess'));
    }

    public function showOrder($id) {
        $order = Orders::with(['rUsers','rVouchers','rOrderDetail'])->find($id);
        $orders = Orders::where('status', 1)->get();
        return view('adminPage.ordersEdit', compact('order', 'orders'));
    }

    public function createOrder() {
        $order = $this->show(0);
        $orders = Orders::where('status', 1)->get();
        return view('adminPage.ordersEdit', compact('order', 'orders'));
    }

    public function storeOrder(Request $request) {
        $this->store($request);
        $order = $this->index();
        return redirect('/admin/order');
    }
}
