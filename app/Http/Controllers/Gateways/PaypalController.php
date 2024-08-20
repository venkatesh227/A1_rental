<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Cart;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {

        $cartitems = Cart::where('user_id', session('userId'))->get();

        foreach ($cartitems as $item) {
            $prod = Product::where('id', $item->prod_id)->first();

            if ($prod->qty >= $item->prod_qty) {

                $prod->qty = $prod->qty - $item->prod_qty;
                // dd($prod->qty);
                $prod->updated_at = Carbon::now('Asia/Calcutta');
                $prod->update();
            } else {
                return redirect('cart')->with('status', 'One or more products are out of stock');
            }
        }



        $provider = new PayPalClient;


        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [

                        "currency_code" => "USD",
                        "value" => $request->grand_total
                    ]
                ]
            ]

        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {

                    $order = new Order();
                    $order->order_no = rand(1111, 9999);
                    $order->user_id = session('userId');
                    $order->no_of_products = $request->input('no_of_products');
                    $order->grand_total = $request->input('grand_total');
                    $order->created_at = Carbon::now('Asia/Calcutta');
                    $order->created_by = session('userId');
                    $order->save();
                    $cartitems = Cart::where('user_id', session('userId'))->get();
        
                    foreach ($cartitems as $item) {
        
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $item->prod_id,
                            'qty' => $item->prod_qty,
                            'subtotal' => $item->products->selling_price * $item->prod_qty,
                            'single_price' => $item->products->selling_price,
                            'created_by' => session('userId'),
        
                        ]);
                    }
                    $cartitems = Cart::where('user_id', session('userId'))->get();
                    Cart::destroy($cartitems);

                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function success(Request $request)
    {

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            return redirect('cart')->with('status', 'order placed successfully');
        }
        return redirect()->route('paypal.cancel');

    }

    public function cancel()
    {
        return redirect('cart')->with('status', 'Payment Failed');
    }
}
