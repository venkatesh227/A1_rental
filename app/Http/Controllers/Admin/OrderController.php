<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserRegister;
use App\Models\OrderDetail;
use App\Models\ProductImages;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order.view', compact('orders'));
    }

    public function view_order($id, $user_id)
    {
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        $userDetails = UserRegister::find($user_id);

        return view('admin.order.order_details', compact('orderDetails', 'userDetails'));
    }

    public function update_order_status(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();

        return redirect('orders')->with('status', "Order Updated Successfully");
    }
}
